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

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/app.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/addCatRow.css">
    <link rel="stylesheet" href="./css/bookCardAdmin.css">
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
                    <li class="sidebar-item "><a class="sidebar-link" href="RemainingLeave.php">Remaining Leaves</a></li>
                    <li class="sidebar-item active"><a class="sidebar-link" href="userUpdateProfile.php">Update Profile</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="userLeaveHistory.php">MyLeave
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
            <h2 class="productsTitle">Update Profile</h2>
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                    <span id="successAlertMsg"></span>
                </div>

                <div class="row py-5 m-auto">
                <!-- Registeration Form -->
                <div class="col-md-7 col-lg-6 m-auto">
                    <div class="row">

                        <label>Email Address</label>
                        <div class="input-group col-lg-6 mb-4">
                            <input id="empEmail" type="email" name="empEmail" placeholder="Email Address"
                                class="form-control bg-white border-left-0 border-md" disabled>
                        </div>

                        <label>Name</label>
                        <div class="input-group col-lg-6 mb-4">
                            <input id="empName" type="text" name="empName" placeholder="Name"
                                class="form-control bg-white border-left-0 border-md">
                        </div>

                        <label>Mobile Number</label>
                        <div class="input-group col-lg-6 mb-4">

                            <input id="empPhone" type="tel" name="empPhone" placeholder="Mobile"
                                class="form-control bg-white border-left-0 border-md">
                        </div>

                        <label>Address</label>
                        <div class="input-group col-lg-6 mb-4">

                            <textarea id="empAddress" rows="3" cols="20" name="empAddress" placeholder="Address"
                                class="form-control bg-white border-left-0 border-md"></textarea>
                        </div>

                        <label>Department</label>
                        <div class="input-group col-lg-6 mb-4">
                            <input id="empDept" type="text" name="empDept" placeholder="Department"
                                class="form-control bg-white border-left-0 border-md">
                        </div>

                        <label>Password</label>
                        <div class="input-group col-lg-6 mb-4">

                            <input id="empPassword" type="password" name="empPassword" placeholder="Password"
                                class="form-control bg-white border-left-0 border-md">
                        </div>

                        <div class="input-group col-lg-6 mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" onclick="showHidePassword()">
                                <label class="form-check-label">
                                    Show Password
                                </label>
                            </div>
                        </div>

                        <div class="ms-1 mb-3" style="font-size: 1.2rem; color: red; display: none;" id="errorMsg">
                            Hello There is
                            an error
                        </div>

                        <div class="form-group col-lg-12 mx-auto mb-0">
                            <button class="btn btn-dark btn-block p-2" onclick="updateProfile()">
                                <span class="font-weight-bold">Update Profile</span>
                            </button>
                        </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        
        //on load 
        window.onload = function () {
            var isValid = '<?php echo $customerID; ?>';
            if (isValid == 0) {
                window.alert("please Login");
                window.location = 'index.html';
            } else {
                getCustomerInfo();
            }
        };

        $(document).ready(function () {
            $("#successAlert").hide();
        });

        function showSuccessAlert(msg) {
            $("#successAlert").fadeTo(2000, 500).slideUp(500, function () {
                $("#successAlert").slideUp(500);
            });
            document.getElementById("successAlertMsg").innerHTML = msg;
        }

        document.getElementById("empName").onfocus = function () {
            hideErrorMsg();
        };
        document.getElementById("empPhone").onfocus = function () {
            hideErrorMsg();
        };
        document.getElementById("empAddress").onfocus = function () {
            hideErrorMsg();
        };
        document.getElementById("empDept").onfocus = function () {
            hideErrorMsg();
        };
        document.getElementById("empPassword").onfocus = function () {
            hideErrorMsg();

        };

        function getCustomerInfo() {

            var XRH = new XMLHttpRequest();
            var url = "./php/getEmployee.php?e_id=" + '<?php echo $customerID; ?>';
            XRH.open('GET', url);

            XRH.onload = function () {
                obj = JSON.parse(this.responseText);
                console.log(obj);
                if (obj != null) {
                    document.getElementById("empName").value = obj.e_name;
                    document.getElementById("empEmail").value = obj.e_mail;
                    document.getElementById("empPhone").value = obj.e_phone;
                    document.getElementById("empAddress").value = obj.address;
                    document.getElementById("empDept").value = obj.dept_name;
                    document.getElementById("empPassword").value = obj.Password;
                }
            }
            XRH.send();
        }

        function hideErrorMsg() {
            document.getElementById("errorMsg").style.display = "none";
        }

        function showErrorMsg(err) {
            document.getElementById("errorMsg").style.display = "block";
            document.getElementById("errorMsg").innerHTML = err;
        }

        function updateProfile() {

            var obj;
            if (document.getElementById("empName").value == "" || document.getElementById("empEmail").value == ""
                || document.getElementById("empPassword").value == "" || document.getElementById("empAddress").value == ""
                || document.getElementById("empDept").value == "" ||document.getElementById("empPhone").value == "") {

                showErrorMsg("Please Provide Inputs!");
            }
            else {
                var data = "empName=" + document.getElementById("empName").value + "&empEmail=" + document.getElementById("empEmail").value
                    + "&empPassword=" + document.getElementById("empPassword").value + "&empAddress=" + document.getElementById("empAddress").value
                   +"&empDept=" + document.getElementById("empDept").value + "&empPhone=" + document.getElementById("empPhone").value + "&empID=" + '<?php echo $customerID; ?>';

                console.log(data);
                var XRH = new XMLHttpRequest();

                XRH.onload = function () {
                    console.log(this.responseText);
                    obj = JSON.parse(this.responseText);

                    if (obj.status) {
                        showSuccessAlert(obj.msg);
                        getCustomerInfo();
                    }
                    else {
                        showErrorMsg(obj.msg)
                    }
                }

                XRH.open('POST', './php/updateUserProfile.php');
                XRH.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                XRH.send(data);
            }
        }

        function showHidePassword() {
            var x = document.getElementById("empPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>