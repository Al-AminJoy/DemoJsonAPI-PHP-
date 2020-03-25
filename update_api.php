<?php  
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
 include "db.php";
    $id = $data["id"];
    $name = $data["name"];
    $phone = $data["phone_number"];

    $sql = "UPDATE sampledata SET name = '$name', phone_number = '$phone',date = NOW() WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo '{"Success"}';
    } else {
        echo '{"Sql error"}';
    }

?>