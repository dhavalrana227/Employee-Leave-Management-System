<?php
session_start();
$email = $_POST["empEmail"];
$password = $_POST["empPassword"];

$con = mysqli_connect("localhost", "root", "", "employee leave");
$check = "SELECT e_id, u_type FROM employee WHERE e_mail='$email' AND Password = '$password'";
$query = mysqli_query($con,$check);
if(mysqli_num_rows($query)>0){
    $row = mysqli_fetch_assoc($query);
    $customerID = $row["e_id"];
    $_SESSION['login'] = true;
    $_SESSION['user'] = $customerID;
    $_SESSION['userType'] = $row["u_type"];
    $_SESSION['e_id']=$row["e_id"];
    echo json_encode(array("status"=>true,"msg"=>"Login Successful","userType"=>$row["u_type"]));
}
else{
    $_SESSION['login'] = false;
    echo json_encode(array("status"=>false,"msg"=>"Invalid username and password!"));
}
