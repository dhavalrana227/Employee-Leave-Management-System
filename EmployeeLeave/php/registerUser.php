<?php
session_start();
$name = $_REQUEST["empName"];
$email = $_REQUEST["empEmail"];
$phone = $_REQUEST["empPhone"];
$address = $_REQUEST["empAddress"];
$dept=$_REQUEST["empDept"];
$dob=$_REQUEST["empDob"];
$password = $_REQUEST["empPassword"];


$con = mysqli_connect("localhost", "root", "", "employee leave");
$check = "SELECT e_id FROM employee WHERE e_mail='$email'";
$query = mysqli_query($con,$check);
if(mysqli_num_rows($query)>0){
    $_SESSION['login'] = false;
    echo json_encode(array("status"=>false,"msg"=>"Employee alreday exist with this email!"));
}
else{
    $addCategory = "INSERT INTO employee (`e_name`,`e_mail`,`Password`,`dept_name`,`e_phone`,`address`,`dob`) VALUES ('$name','$email','$password','$dept','$phone','$address','$dob')";
    $result = mysqli_query($con, $addCategory);
    if($result){
        $fetchLastOrderID = "SELECT e_id from employee ORDER BY e_id DESC LIMIT 1";
        $exe = mysqli_query($con,$fetchLastOrderID);
        $row = mysqli_fetch_assoc($exe);
        $customerID = $row["e_id"];
        $_SESSION['login'] = true;
		$_SESSION['user'] = $customerID;
        echo json_encode(array("status"=>true,"msg"=>"Registration Successful"));
    }
    else{
        $_SESSION['login'] = false;
        echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
    }
}
