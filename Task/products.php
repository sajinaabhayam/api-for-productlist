<?php
   
// Database Connection

$con = new mysqli("localhost", "root", "", "interview_task");

//Retrive data from database

$stmt = $con->prepare("SELECT * FROM tbl_products ");
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);
   
// Use json_encode() function
$json = json_encode($outp);
   
// Display the output
echo($json);
   
?>