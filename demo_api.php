
<?php
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {

 	case 'GET': // read data

		 getOperation();

    	break;

    case 'POST': // create data
         $data = json_decode(file_get_contents('php://input'), true);
         //  print_r($data);
         postOperation($data);

        break;

    case 'PUT': // update data
      $data = json_decode(file_get_contents('php://input'), true);  // true means,can convert data to array

      putOperation($data);

      break;

   case 'DELETE': // delete data
      $data = json_decode(file_get_contents('php://input'), true);  // true means you can convert data to array

	  deleteOperation($data);

      break;

  default:
    	print('{"result": "Requested http method not supported here."}');

}

function getOperation(){

    include "db.php";

    $sql = "SELECT * FROM sampledata";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
      $rows = array();
       while($r = mysqli_fetch_assoc($result)) {
          $rows["result"][] = $r; // with result object
        //  $rows[] = $r; // only array
       }
      echo json_encode($rows);

    } else {
        echo '{"result": "No data found"}';
    }

  }

  function postOperation($data){
// print_r($data);
  
    include "db.php";

    $name = $data["name"];
    $phone = $data["phone_number"];

    $sql = "INSERT INTO sampledata(name, phone_number,date) VALUES('$name','$phone',NOW())";

    if (mysqli_query($conn, $sql)) {
        echo '{"Success"}';
    } else {
        echo '{"Sql error"}';
    }

  }

    function putOperation($data){
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

  }
function deleteOperation($data){

    include "db.php";

    $id = $data["id"];

    $sql = "DELETE FROM sampledata WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo '{"Success"}';
    } else {
        echo '{"Sql error"}';
    }

  }

?>
