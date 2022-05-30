<?php
// To Chechk Session (Is User Login Or Not)
// Reason: Without User Login It can't Access Cart

session_start();
// Validation
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
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootsrap CSS And JQuery Libs -->
    <link rel="stylesheet" href="css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/addCatRow.css">
    <script src="logout.js"></script>

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar Navigation -->
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">

                <h4 class="sidebarTitle">Leave Me</h4>

                <ul class="sidebar-nav">
                    <li class="sidebar-item "><a class="sidebar-link" href="test.php">Apply for Leave</a>
                    </li>
                    <li class="sidebar-item "><a class="sidebar-link" href="RemainingLeave.php">Remaining Leaves</a></li>
                    <li class="sidebar-item "><a class="sidebar-link" href="userUpdateProfile.php">Update Profile</a>
                    </li>
                    <li class="sidebar-item active"><a class="sidebar-link" href="userLeaveHistory.php">MyLeave
                            History</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="./php/logoutUser.php">Logout</a></li>
                </ul>
            </div>
        </nav>
        <!-- End Of Sidebar Navigation -->

        <div class="main">

            <!-- Sidebar Navigation Hamburger Icon -->
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                    </ul>
                </div>
            </nav>
            <!-- End Of Sidebar Navigation Hamburger Icon -->

            <!-- Main Starts -->
            <main class="content">
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
            </main>
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