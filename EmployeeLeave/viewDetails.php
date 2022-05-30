<?php
// To Chechk Session (Is User Login Or Not)
// Reason: Without User Login It can't Access Cart

session_start();
// Validation
if(isset($_SESSION['login']) && $_SESSION['login'] == true && isset($_SESSION['user'])){
    if(isset($_SESSION['login']) && $_SESSION['userType']=="admin")
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

    <link rel="stylesheet" href="css/app.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/addCatRow.css">
    <link rel="stylesheet" href="./css/ordersStyles.css">
    <script src="logout.js"></script>


</head>

<body>

    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">

                <h4 class="sidebarTitle">Leave Me</h4>

                <ul class="sidebar-nav">
                    <li class="sidebar-item "><a class="sidebar-link" href="addLeave.php">Add Leave Type</a>
                    </li>
                    <li class="sidebar-item "><a class="sidebar-link" href="leaveManagement.php">Leave Management</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="updateDeleteLeavesList.php">Update/
                            Delete Leave Type</a>
                    </li>
                    <li class="sidebar-item active"><a class="sidebar-link" href="leavesHistory.php">Leave
                            History</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="./php/logoutUser.php">Logout</a></li>
                </ul>
            </div>
        </nav>


        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Employee</strong>&nbspDetails</h3>

                        </div>
                        <div id="updateDeleteBook" class="container mt-5 ">
                            <div class="cont">
                                <div class="row align-items-center justify-content-start">

                                    <table class="table table-striped cartItemsTable">
                                        <thead>
                                            <tr class="cartItemsTableHeading">
                                                <!-- <th class="col-auto">Posting Date</th>
                                                <th class="col-auto">Leave Type</th>
                                                <th class="col-auto">Status</th>
                                                <th class="col-auto">Employee Details</th>
                                                <th class="col-auto">Action</th> -->
                                            </tr>
                                        </thead>

                                        <tbody id="ordersRow">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
    <script src="js/app.js"></script>
    <script>
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

        // Fetch Categories From Datbase....
        function fetchOrders() {
            var qs=location.search.substring(1);
            // var data = "leaveID=" + 4;
            console.log(qs);
            var XRH = new XMLHttpRequest();
            XRH.open('POST', './php/getLeaveDetails2.php');
            XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            XRH.send(qs);
            XRH.onload = function () {
                obj = JSON.parse(this.responseText);

                for (let leave of obj) {
                    var sts="";
                    if(leave.Status==0){sts="waiting for approval";}
                    if(leave.Status==1){sts="Approved";}
                    if(leave.Status==2){sts="Not Approved";}
                    tableData += '<tr><td><p><b>Employee Id: </b>' + leave.leaveID + '</p></td><td><p><b>Employee Name: </b>' + leave.e_name + '</p></td><td><p><b>Email: </b>' + leave.e_mail + '</p></td></tr><tr><td><p><b>Contact: </b>' + leave.e_phone + '</p></td><td><p><b>Department: </b>' + leave.department + '</p></td></tr><tr><td><p><b>Leave Type:</b>'+leave.LeaveType+'</p></td><td><p><b>Leave From Date:</b>'+leave.FromDate+'</p></td><td><p><b>Leave To Date:</b>'+leave.ToDate+'</p></td></tr><tr><td><p><b>Description:</b>'+leave.Description+'</p></td><td><p><b>Posting Date:</b>'+leave.PostingDate+'</p></td></tr><tr><td><p><b>Status:</b>'+sts+'</p></td><td></td><td></td></tr><tr><td><p><b>Admin Remark:</b>'+leave.AdminRemark+'</p></td></tr><tr><td><p><b>Admin Remark Date:</b>'+leave.AdminRemarkDate+'</p></td><td></td><td></td></tr>';
                }
                document.getElementById("ordersRow").innerHTML = tableData;
            }
           
        }
    </script>

</body>

</html>
