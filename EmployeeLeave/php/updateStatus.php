<?php
$leaveID=$_REQUEST['leaveID'];
$leave_status = $_REQUEST["leave_status"];
$leave_dec = $_REQUEST["leave_dec"];
$PostingDate = $_REQUEST["PostingDate"];
//$AdminRemarkDate = $_REQUEST["AdminRemarkDate"];
date_default_timezone_set('Asia/Kolkata');
$admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));


$con = mysqli_connect("localhost", "root", "", "employee leave");

$sql1 = "SELECT * FROM tblleaves WHERE e_id='$leaveID' AND PostingDate='$PostingDate'";
$res1 = mysqli_query($con, $sql1);
while($row1 = mysqli_fetch_assoc($res1)){
    $sts = $row1["Status"];
    $fromDate = $row1["FromDate"];
    $toDate = $row1["ToDate"];
    $RemainingLeave = $row1["RemainingLeave"];
}
$date1 = strtotime($toDate);
$date2 = strtotime($fromDate);
$diff = abs($date1 - $date2);
$days= ($diff/86400)+1;
$days=intval($days);

if($leave_status == 2){
    $recover = $days + $RemainingLeave;
    $take = 0;
    echo "Taken".$days."  "."RemainLeave".$RemainingLeave."    "."Recover".$recover;
    $selectCust = "UPDATE tblleaves set AdminRemark='$leave_dec', Status='$leave_status', AdminRemarkDate='$admremarkdate',RemainingLeave='$recover',LeaveTaken='$take' WHERE e_id='$leaveID' AND PostingDate='$PostingDate'";
    $result = mysqli_query($con, $selectCust);
    if($result){
        echo json_encode(array("status"=>true,"msg"=>"Leave Type Updated!"));
    }
    else{
        echo json_encode(array("status"=>false,"msg"=>"Something went wrong!"));
    }
}
else{
    $selectCust = "UPDATE tblleaves set AdminRemark='$leave_dec', Status='$leave_status', AdminRemarkDate='$admremarkdate' WHERE e_id='$leaveID' AND PostingDate='$PostingDate'";
    $result = mysqli_query($con, $selectCust);
    if($result){
        echo json_encode(array("status"=>true,"msg"=>"Leave Type Updated!"));
    }
    else{
        echo json_encode(array("status"=>false,"msg"=>"Something went wrong!"));
    }
}



