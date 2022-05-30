<?php
$leave_type = $_POST["leave_type"];
$leave_dec = $_POST["leave_dec"];
$leave_total = $_POST["leave_total"];


$con = mysqli_connect("localhost", "root", "", "employee leave");
$selectCust = "UPDATE leave_type set leave_dec='$leave_dec', Total_leave='$leave_total' WHERE leave_type='$leave_type'";
$result = mysqli_query($con, $selectCust);
if($result){
    echo json_encode(array("status"=>true,"msg"=>"Leave Type Updated!"));
}
else{
    echo json_encode(array("status"=>false,"msg"=>"Something went wrong!"));
}