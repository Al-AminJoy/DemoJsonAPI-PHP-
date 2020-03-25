<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
// print_r($data);
  
 include "db.php";

    $name = $data["name"];
    $phone = $data["phone_number"];

    $sql = "INSERT INTO sampledata(name, phone_number,date) VALUES('$name','$phone',NOW())";

    if (mysqli_query($conn, $sql)) {
        echo ("Success");
    } else {
        echo ("Sql error");
    }
 ?>