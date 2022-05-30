<?php
$con = mysqli_connect("localhost", "root", "", "employee leave");
$records = array();
$select = "SELECT * FROM tblleaves WHERE Status=0";
$result= mysqli_query($con, $select);

while($row = mysqli_fetch_assoc($result)){
    $empID = $row["e_id"];
    $leaveID = $row["id"];
    $LeaveType=$row["LeaveType"];
    $PostingDate=$row["PostingDate"];
    $Status=$row["Status"];
    $ToDate=$row["ToDate"];
    $FromDate=$row["FromDate"];
    $Description=$row["Description"];
    $AdminRemark=$row["AdminRemark"];
    $AdminRemarkDate=$row["AdminRemarkDate"];
    
    $selectEmp = "SELECT e_id, e_name, e_mail, e_phone, dept_name  FROM employee WHERE e_id='$empID'";
    $result1 = mysqli_query($con, $selectEmp);
    $row1 = mysqli_fetch_assoc($result1);

      
    $records[] = array("leaveID"=>$empID,"ToDate"=>$ToDate,"FromDate"=>$FromDate,"Description"=>$Description,"AdminRemark"=>$AdminRemark,"AdminRemarkDate"=>$AdminRemarkDate,"PostingDate"=>$PostingDate,"LeaveType"=>$LeaveType,"Status"=>$Status,"e_name"=>$row1["e_name"],"e_phone"=>$row1["e_phone"],"e_mail"=>$row1["e_mail"],"department"=>$row1["dept_name"]);
}
echo json_encode($records);