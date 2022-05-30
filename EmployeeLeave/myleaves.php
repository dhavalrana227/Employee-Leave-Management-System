<?php
session_start();
if(isset($_SESSION['login']) && $_SESSION['login'] == true && isset($_SESSION['user'])){
    if(isset($_SESSION['login']) && $_SESSION['userType']=="")
    {
        $customerID = $_SESSION['user'];
    }
    else{
        $customerID = 0; 
    }
}else{
  $customerID = 0;
}
?>
<html>

<head>
    <!-- Bootsrap CSS And JQuery Libs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

         <!-- special version of bootsrap for nav bar (hamburger) 
        New version no support -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/myOrdersStyle.css">

</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light" id="myNavBar">
        <a class="navbar-brand logo" href="test.php">Leave Me</a>

        <!-- Navigation Bar (Hamburger Icon) -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">

                <a class="nav-link mr-1" href="test.php">Home </a>
                <a class="nav-link mr-1" href="products.php">Products</a>
                <a class="nav-link mr-1" href="gallery.php">Gallery</a>
                <a class="nav-link mr-1" href="myCart.php">MyCart</a>
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        My Profile
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="updateprofile.php">Update Profile</a></li>
                        <li><a class="dropdown-item" href="myleaves.php">Leave History</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="./php/logoutUser.php">Logout</a></li>
                    </ul>
                </li>

            </div>
        </div>
    </nav>
    <!-- End Of Navigation Bar -->

    <!-- My Orders Title  -->
    <h2 class="productsTitle">My Leaves</h2>

    <!-- Orders Empty Image And Text (Display When Orders Is Empty Otherwise Not) -->
    <div class="container-fluid" id="productsEmptyPage" style="display: none;">
        <center>
            <img src="./images//noorder.png" height="500rem" class="p-3">
            <h3 class="mt-5">You don't have any leave history yet!</h3>
        </center>
    </div>

    <div class="container-fluid pt-1 ps-5 pe-5 ms-4" id="productsPage">
        <div class="row mb-2 mb-xl-3">

            <div id="updateDeleteBook" class="container mt-5">
                <div class="cont">
                    <div class="row align-items-center justify-content-start" data-aos="fade-right"
                        data-aos-duration="1500">

                        <!-- Order Items Table  -->
                        <table class="table table-striped" style="font-size:1.2rem;">
                            <thead>
                                <tr style="font-size:1.4rem;">
                                    <th class="col-auto">Leave Type</th>
                                    <th class="col-auto">From</th>
                                    <th class="col-auto">To</th>
                                    <th class="col-auto">Description</th>
                                    <th class="col-auto">Posting Date</th>
                                    <th class="col-auto">Admin Remark</th>
                                    <th class="col-auto">Status</th>
                                </tr>
                            </thead>

                            <tbody id="ordersRow" class="myOrdersRow">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Javascripts..... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Custom JS -->
    <script>
        // OnLoad Function
        window.onload = function () {
            // If User Loggdin Or Not
            var isValid = '<?php echo $customerID; ?>';

            if (isValid == 0) {
                // If Not LoggedIn
                window.alert("please Login");
                window.location = 'index.html';
            } else {
                fetchOrders();
            }
        };

        // Global Varibles
        var obj = null;
        var tableData = "";
        var url = "./php/getMyLeaves.php?customerID=" + '<?php echo $customerID; ?>';

        // Fetch Categories From Datbase....
        function fetchOrders() {
            var XRH = new XMLHttpRequest();
            XRH.open('GET', url);

            XRH.onload = function () {
                obj = JSON.parse(this.responseText);
                if (obj.length > 0) {
                    for (let leave of obj) {
                        var sts="";
                        var ssts="";
                        if(leave.Status==0){sts="waiting for approval"; 
                        ssts=sts.fontcolor("blue");}
                        if(leave.Status==1){sts="Approved";
                        ssts=sts.fontcolor("green");}
                        if(leave.Status==2){sts="Not Approved";
                        ssts=sts.fontcolor("red");}
                        tableData += '<tr><td>' + leave.LeaveType + '</td><td> ' + leave.FromDate + '</td><td>' + leave.ToDate + '</td><td>' + leave.Description + '</td><td>' + leave.PostingDate + '</td><td>' + leave.AdminRemark + '</td><td>' + ssts + '</td></tr>';
                    }
                    document.getElementById("ordersRow").innerHTML = tableData;
                    console.log(tabledata);
                } else {
                    document.getElementById("productsEmptyPage").style.display = "block";
                    document.getElementById("productsPage").style.display = "none";
                }

            }
            XRH.send();
        }
        AOS.init();
    </script>
</body>

</html>