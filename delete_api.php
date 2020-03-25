<?php  
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
include "db.php";

    $id = $data["id"];

    $sql = "DELETE * FROM sampledata WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo '{"result": "Success"}';
    } else {
       echo '{"result": "Sql error"}';
    }

  
 ?>