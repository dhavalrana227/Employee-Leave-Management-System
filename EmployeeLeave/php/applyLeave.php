<?php
$e_id = $_POST["e_id"];
$lvType = $_POST["leaveType"];
$fromDate = $_POST["fromDate"];
$toDate = $_POST["toDate"];
$lvDesc = $_POST["Description"];
date_default_timezone_set('Asia/Kolkata');
$postingDate=date('Y-m-d G:i:s ', strtotime("now"));

$date1 = strtotime($toDate);
$date2 = strtotime($fromDate);
$diff = abs($date1 - $date2);
$days= ($diff/86400)+1;
$days=intval($days);

$con = mysqli_connect("localhost", "root", "", "employee leave");

    $sql = "SELECT Total_leave FROM leave_type WHERE leave_type='$lvType'";
    $res= mysqli_query($con, $sql);
   
    while($row = mysqli_fetch_assoc($res))
    {
        $total = $row['Total_leave'];
        
    }
    
    //$remain = $total-$days;
    //echo $days;
    if($days > $total)
    {
        echo json_encode(array("status"=>false,"msg"=>"Maximum ".$total." Days Allowed For".$lvType." Leave."));
    }
    else
    {
            $sql3 = "SELECT * FROM tblleaves WHERE e_id='$e_id' AND LeaveType='$lvType'";
            $res3= mysqli_query($con, $sql3);
            while($row3 = mysqli_fetch_assoc($res3)){
                $remainLeave = $row3['RemainingLeave'];
            }
            
            if(isset($remainLeave)){
                    $remain2 = $remainLeave - $days;
                    if($remain2 > 0){
                        $addLeave = "INSERT INTO tblleaves(`LeaveType`,`ToDate`,`FromDate`,`Description`,`PostingDate`,`MaxAllowedLeave`,`LeaveTaken`,`RemainingLeave`,`e_id`) VALUE('$lvType','$toDate','$fromDate','$lvDesc','$postingDate','$total','$days','$remain2','$e_id')";
                        $result = mysqli_query($con, $addLeave);
                        if($result){
                            echo json_encode(array("status"=>true,"msg"=>"Apply Successfully"));
                        }
                        else{
                            echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
                        }
                    }
                    else{
                        echo json_encode(array("status"=>false,"msg"=>"Please Check Your Remaining Leaves First!!!"));
                    }
            }
            else{
                    $remain1 = $total - $days;
                    $addLeave = "INSERT INTO tblleaves(`LeaveType`,`ToDate`,`FromDate`,`Description`,`PostingDate`,`MaxAllowedLeave`,`LeaveTaken`,`RemainingLeave`,`e_id`) VALUE('$lvType','$toDate','$fromDate','$lvDesc','$postingDate','$total','$days','$remain1','$e_id')";
                    $result = mysqli_query($con, $addLeave);
                    if($result){
                        echo json_encode(array("status"=>true,"msg"=>"Apply Successfully"));
                    }
                    else{
                        echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
                    }
                         
            }                
    }
        
