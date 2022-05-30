<?php
$con = mysqli_connect("localhost", "root", "", "employee leave");
$records = array();
$selectCust = "SELECT * FROM leave_type";
$result = mysqli_query($con, $selectCust);
while ($row = mysqli_fetch_assoc($result)) {
    $records[] = $row; 
}
echo json_encode($records);