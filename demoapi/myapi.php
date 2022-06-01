<?php 

header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
	case 'GET':
		handleGetOperation();
		break;
		case 'POST':
		$data = json_decode(file_get_contents('php://input'), true);
		handlePostOperation($data);
		break;
		case 'PUT':
		$data = json_decode(file_get_contents('php://input'), true);
		handlePutOperation($data);
		break;
		
		case 'DELETE':
		$data = json_decode(file_get_contents('php://input'), true);
		handleDeleteOperation($data);
	break;

	default:
		echo '{"result": "not supported"}';
		break;
}


function handleGetOperation() {
	include "db.php";
	$sql = "SELECT * FROM testtable";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$rows = array();
		while ($r = mysqli_fetch_assoc($result)) {
		$rows ["result"] []= $r;
	}
	echo json_encode($rows);

	} else { 
		echo '{"result" : "No data found"}';
	}
	}
function handlePostOperation($data) {
	include "db.php";
	$name = $data["name"];
	$phone = $data["phone"];
	
	// $area = $data["address"]["area"];
	// $road = $data["address"] ["road"];
	// $fulladdress = $area + "," + $road;
	$sql = "INSERT INTO testtable(name, phone, datetime) VALUES('$name', '

		$phone',  + NOW())";
	
	if (mysqli_query($conn, $sql)) {
		echo '{"result": "Success"}';
		} else {
			echo '{"result": "sql error"}';
		}
	}
function handlePutOperation($data) {
	include "db.php";
		$id = $data["id"];
		$name = $data["name"];
		$phone = $data["phone"];
	
	// $area = $data["address"]["area"];
	// $road = $data["address"] ["road"];
	// $fulladdress = $area + "," + $road;
	$sql = "UPDATE testtable SET name = '$name', phone = '$phone', datetime = NOW() where id = '$id'";
	
	if (mysqli_query($conn, $sql)) {
		echo '{"result": "Success"}';
		} else {
			echo '{"result": "sql error"}';
		
	}
}

function handleDeleteOperation($data) {
	 include "db.php";
		$id = $data["id"];
		
	// $area = $data["address"]["area"];
	// $road = $data["address"] ["road"];
	// $fulladdress = $area + "," + $road;
	$sql = "DELETE FROM testtable WHERE id = $id";
	
	if (mysqli_query($conn, $sql)) {
		echo '{"result": "Success"}';
		} else {
			echo '{"result": "sql error"}';
	
	}
}

?>