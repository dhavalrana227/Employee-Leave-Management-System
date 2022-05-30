<?php
session_start();
$e_id = $_REQUEST["e_id"];

$con = mysqli_connect("localhost", "root", "", "employee leave");
$check = "SELECT * FROM employee WHERE e_id = '$e_id'";
$query = mysqli_query($con,$check);
if(mysqli_num_rows($query)>0){
    $row = mysqli_fetch_assoc($query);
    echo json_encode(array("e_id"=>$row["e_id"],"e_name"=>$row["e_name"],"e_mail"=>$row["e_mail"],"e_phone"=>$row["e_phone"],"address"=>$row["address"],"dept_name"=>$row["dept_name"],"Password"=>$row["Password"]));
}
