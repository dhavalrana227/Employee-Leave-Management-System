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
                    <li class="sidebar-item "><a class="sidebar-link" href="test.php">Apply for Leave</a>
                    </li>
                    <li class="sidebar-item active"><a class="sidebar-link" href="RemainingLeave.php">Remaining Leaves</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="userUpdateProfile.php">Update Profile</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="userLeaveHistory.php">MyLeave
                            History</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="./php/logoutUser.php">Logout</a></li>
                </ul>
            </div>
        </nav>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update Leave Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row addCatRow">
                            <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                <b class="addCatRowTitle">Leave Type Name: </b>
                                <b class="addCatRowTitle" id="leaveIDModal"></b>
                            </div>
                        </div>

                        <div class="row addCatRow">
                            <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                <b class="addCatRowTitle">Leave Description: </b>
                                <input type="text" name="leaveName" id="leaveNameModal" placeholder="Enter Leave Type Description"
                                    class="form-control mt-2">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" onclick="updateLeaveData()">Update Leave Type</button>
                    </div>
                </div>
            </div>
        </div>


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
                            <h3><strong>Leaves</strong>&nbspHistory</h3>

                        </div>
                        <div id="updateDeleteBook" class="container mt-5 ">
                            <div class="cont">
                                <div class="row align-items-center justify-content-start">

                                    <table class="table table-striped cartItemsTable">
                                        <thead>
                                            <tr class="cartItemsTableHeading">
                                                <th class="col-auto">Leave Type</th>
                                                <th class="col-auto">MaxAllowedLeave</th>
                                                <th class="col-auto">LeavesTaken</th>
                                                <th class="col-auto">RemainingLeave</th>
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
            var isValid = '<?php echo $customerID; ?>';
            console.log(isValid);
            var data = "e_id=" + isValid;
            console.log(data);
            var XRH = new XMLHttpRequest();
            XRH.open('POST', './php/remainLeave.php');
            XRH.send(data);
            XRH.onload = function () {
                obj = JSON.parse(this.responseText);
                
                
                for (let leave of obj) {
                    
                    tableData += '<tr><td>' + leave.LeaveType + '</td><td> ' + leave.MaxAllowedLeave + '</td><td>' + leave.LeaveTaken + '</td><td><p>' + leave.RemainingLeave + '</p></td></tr>';
                }
                document.getElementById("ordersRow").innerHTML = tableData;
            }
            
        }
    </script>

</body>

</html>