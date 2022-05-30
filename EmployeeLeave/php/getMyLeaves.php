<?php
$empID1 = $_REQUEST["customerID"];
$con = mysqli_connect("localhost", "root", "", "employee leave");
$records = array();
$select = "SELECT * FROM tblleaves WHERE e_id = '$empID1' ORDER BY PostingDate DESC";
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
    $selectEmp = "SELECT e_id, e_name, e_mail, e_phone, dept_name  FROM employee WHERE e_id='$empID'";
    $result1 = mysqli_query($con, $selectEmp);
    $row1 = mysqli_fetch_assoc($result1);

    // $selectItem = "SELECT bookID, quantity  FROM order_items WHERE orderID='$orderID'";
    // $result2 = mysqli_query($con, $selectItem);
    // $str="";
    // while($row2 = mysqli_fetch_assoc($result2)){
    //     $bookID = $row2["bookID"];
    //     $qty = $row2["quantity"];

    //     $selectBook= "SELECT bookName FROM books WHERE bookID='$bookID'";
    //     $result3 = mysqli_query($con, $selectBook);
    //     $row3 = mysqli_fetch_assoc($result3);
    //     $str .= $row3["bookName"]." x".$qty."<br>";
    // }
    $records[] = array("empID"=>$empID,"ToDate"=>$ToDate,"FromDate"=>$FromDate,"Description"=>$Description,"AdminRemark"=>$AdminRemark,"PostingDate"=>$PostingDate,"LeaveType"=>$LeaveType,"Status"=>$Status,"e_name"=>$row1["e_name"],"e_phone"=>$row1["e_phone"],"e_mail"=>$row1["e_mail"],"department"=>$row1["dept_name"]);
}
echo json_encode($records);