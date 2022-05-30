<?php
$name = $_POST["empName"];
$phone = $_POST["empPhone"];
$address = $_POST["empAddress"];
$dept_name=$_POST["empDept"];
$password = $_POST["empPassword"];
$customerID = $_POST["empID"];

$con = mysqli_connect("localhost", "root", "", "employee leave");

    $addCategory = "UPDATE employee set e_name='$name', e_phone='$phone', address='$address',dept_name='$dept_name', Password='$password' WHERE e_id='$customerID'";
    $result = mysqli_query($con, $addCategory);
    if($result){
        echo json_encode(array("status"=>true,"msg"=>"Profile Updated Successfully"));
    }
    else{
        echo json_encode(array("status"=>false,"msg"=>"Something went wrong!"));
    }
