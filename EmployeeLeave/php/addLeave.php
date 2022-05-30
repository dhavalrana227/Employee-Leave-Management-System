<?php
$lvName = $_POST["LeaveName"];
$lvDesc = $_POST["LeaveDesc"];
$lvTotal = $_POST["TotLeave"];

$con = mysqli_connect("localhost", "root", "", "employee leave");
$check = "SELECT leave_type FROM leave_type WHERE leave_type='$lvName'";
$query = mysqli_query($con,$check);
if(mysqli_num_rows($query)>0){
    echo json_encode(array("status"=>false,"msg"=>"Leave-Type alreday exist!"));
}
else{
    $addLeave = "INSERT INTO leave_type VALUE('$lvName','$lvDesc','$lvTotal')";
    $result = mysqli_query($con, $addLeave);
    if($result){
        echo json_encode(array("status"=>true,"msg"=>"Leave-Type added Successfully"));
    }
    else{
        echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
    }
}
