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
                    <li class="sidebar-item active"><a class="sidebar-link" href="test.php">Apply for Leave</a>
                    </li>
                    <li class="sidebar-item "><a class="sidebar-link" href="RemainingLeave.php">Remaining Leaves</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="userUpdateProfile.php">Update Profile</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="userLeaveHistory.php">MyLeave
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
                <div class="container-fluid p-0">
                    <div class="row mb-2 mb-xl-3">

                        <!-- Add Categories Title -->
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>APPLY</strong>&nbspFOR LEAVE</h3>

                            <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                                <span id="successAlertMsg"></span>
                            </div>
                        </div>

                        <!-- Start Of Inputs Elements -->
                        <div id="addBook" class="container mt-5 ">
                            <div class="cont">

                                <!-- Start Of Form -->
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="addBookForm"
                                    enctype="multipart/form-data" onsubmit="return addBookToDB()">

                                    <!-- Select Category -->
                                    <div class="row addCatRow">
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <b class="addCatRowTitle">Select Category: </b>
                                            <select name="leaveType" id="leaveType" class="form-control mt-2">
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Leave From Date -->
                                    <div class="row addCatRow">
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <b class="addCatRowTitle">Leave From Date: </b>
                                            <input type="date" name="fromDate" id="fromDate"
                                                placeholder="Enter From Date" class="form-control mt-2">
                                        </div>
                                    </div>

                                    <!-- Leave To Date -->
                                    <div class="row addCatRow">
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <b class="addCatRowTitle">Leave To Date: </b>
                                            <input type="date" name="toDate" id="toDate"
                                                placeholder="Enter To Date" class="form-control mt-2">
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="row addCatRow">
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <b class="addCatRowTitle">Description: </b>
                                            <input type="text" name="Description" id="Description"
                                                placeholder="Description" class="form-control mt-2">
                                        </div>
                                    </div>

                                    </div>

                                <!-- Error Msg (Invalid Inputs) -->
                                <div class="ms-2" style="font-size: 1.2rem; color: red; display: none;" id="errorMsg">
                                    Hello There is
                                    an error
                                </div>

                                <!-- Submit Button -->
                                <div class="row addCatRow">
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <input type="button" name="ADD" class="btn btn-dark addCatButton"
                                            onclick="addLeaveToDB()" value="Apply Leave">
                                    </div>
                                </div>
                            </div>
                        </div>
            </main>
        </div>
    </div>

    <!-- Bootsrap And JQuery Libs -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
    <script src="js/app.js"></script>

    <!-- Custom Scripts -->
    <script>
        // OnLoad Function
        window.onload = function () {
            // If User Loggdin Or Not
            var isValid = '<?php echo $customerID; ?>';
            
            if (isValid == 0) {
                // If Not LoggedIn
                window.alert("please Login");
                window.location = 'index.html';
            }else {
                // Fetch Categories List For Select Box
                fetchLeaveType();
            }
        }
        // Hide Alert On Load 
        $(document).ready(function () {
            $("#successAlert").hide();
        });

        var selectLvOptions = "";

        // Funtion Fetch Categories
        function fetchLeaveType() {
            var XRH = new XMLHttpRequest();
            XRH.open('GET', './php/getLeave.php');

            // By Default Option (--Select Category--)
            selectLvOptions = '<option selected value=>--Select Leave Type--</option>';

            XRH.onload = function () {
                obj = JSON.parse(this.responseText);
                for (let leave of obj) {
                    selectLvOptions += '<option value=' + leave.leave_type + '>' + leave.leave_type + '</option>';
                }
                document.getElementById("leaveType").innerHTML = selectLvOptions;
            }
            XRH.send();
        }

        // On Focus Of Any Input Element Hide Error Msg...
        // Use : After Error Msg If User Try to Insert Values Hide Error
        document.getElementById("fromDate").onfocus = function () {
            hideErrorMsg();
            
        };

        // Use : After Error Msg If User Try to Insert Values Hide Error
        document.getElementById("toDate").onfocus = function () {
            hideErrorMsg();
            
        };
        document.getElementById("Description").onfocus = function () {
            hideErrorMsg();
            
        };

        // Function To Hide Error Msg (Red Invalid Input Msg)
        function hideErrorMsg() {
            document.getElementById("errorMsg").style.display = "none";
        }

        // Function To Show Error Msg (Red Invalid Input Msg)
        function showErrorMsg(err) {
            document.getElementById("errorMsg").style.display = "block";
            document.getElementById("errorMsg").innerHTML = err;
        }

        // Function To Add Leave To Database
        function addLeaveToDB() {
            var obj;
            
            // Input Validation
            if (document.getElementById("fromDate").value == "" || document.getElementById("toDate").value == ""|| document.getElementById("Description").value == "") {
                showErrorMsg("Please Provide Inputs!");
            }
            else {

                // Data To Send To Php
                var isValid = '<?php echo $customerID; ?>';
                var data = "e_id=" + isValid + "&leaveType=" + document.getElementById("leaveType").value + "&fromDate=" + document.getElementById("fromDate").value + "&toDate=" + document.getElementById("toDate").value + "&Description=" + document.getElementById("Description").value;
                console.log(data);
                var XRH = new XMLHttpRequest();

                XRH.onload = function () {
                    console.log(this.responseText);
                    obj = JSON.parse(this.responseText);

                    if (obj.status) {
                        showSuccessAlert(obj.msg);
                    }
                    else {
                        showErrorMsg(obj.msg)
                    }
                }

                XRH.open('POST', './php/applyLeave.php');
                XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                XRH.send(data);
            }
        }

        // Function To Show Success Alert (Ex. Leave Added Success)
        function showSuccessAlert(msg) {
            $("#successAlert").fadeTo(2000, 500).slideUp(500, function () {
                $("#successAlert").slideUp(500);
            });
            document.getElementById("successAlertMsg").innerHTML = msg;
        }

        // Hide Alert On Load 
        $(document).ready(function () {
            $("#successAlert").hide();
        });

    </script>
</body>

</html>