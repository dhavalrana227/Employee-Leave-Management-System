<?php
$leave_type = $_REQUEST["leave_type"];
$con = mysqli_connect("localhost", "root", "", "employee leave");
$selectCust = "DELETE FROM leave_type WHERE leave_type='$leave_type'";
$result = mysqli_query($con, $selectCust);
if($result){
    echo json_encode(array("status"=>true,"msg"=>"Leave Type Deleted!"));
}
else{
    echo json_encode(array("status"=>false,"msg"=>"Something went wrong!"));
}