<?php
$con = mysqli_connect("localhost", "root", "", "employee leave");
$records = array();
$selectCust = "SELECT leave_type,leave_dec,Total_leave FROM leave_type";
$result = mysqli_query($con, $selectCust);
while ($row = mysqli_fetch_assoc($result)) {
    $records[] = array("leave_type"=>$row["leave_type"],"lvDec"=>$row["leave_dec"],"lvTotal"=>$row["Total_leave"]);
}
echo json_encode($records);