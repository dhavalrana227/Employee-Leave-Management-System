<?php
//$e_id = $_REQUEST["e_id"];
$con = mysqli_connect("localhost", "root", "", "employee leave");

$records = array();
$select = "SELECT DISTINCT LeaveType,e_id,MaxAllowedLeave FROM tblleaves";
$result= mysqli_query($con, $select);

while($row = mysqli_fetch_assoc($result)){
    $empID = $row["e_id"];
    $LeaveType=$row["LeaveType"];
    $MaxAllowedLeave = $row["MaxAllowedLeave"];
    
    $select2 = "SELECT  SUM(LeaveTaken),MIN(RemainingLeave)  FROM tblleaves WHERE e_id='$empID' AND LeaveType='$LeaveType'";
    $result2 = mysqli_query($con, $select2);
    while($row1 = mysqli_fetch_assoc($result2)){
        $LeaveTaken = $row1["SUM(LeaveTaken)"];
        $RemainingLeave = $row1["MIN(RemainingLeave)"];
    }   
    $records[] = array("leaveID"=>$empID,"MaxAllowedLeave"=>$MaxAllowedLeave,"LeaveType"=>$LeaveType,"LeaveTaken"=>$LeaveTaken,"RemainingLeave"=>$RemainingLeave);
    
}

echo json_encode($records);