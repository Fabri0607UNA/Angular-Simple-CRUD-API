<?php

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
    header('Access-Control-Max-Age: 1728000');
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    die();
}

header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include_once 'db.php';

$database = new Database();
$db = $database->getConnection();

$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method) {
    case 'GET':
        // Handle GET requests
        if(!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            get_employees($id);
        } else {
            get_employees();
        }
        break;
    case 'POST':
        // Handle POST requests
        add_employee();
        break;
    case 'PUT':
        // Handle PUT requests
        $id = intval($_GET["id"]); // Obtener el ID de la solicitud PUT
        update_employee($id);
        break;
    case 'DELETE':
        // Handle DELETE requests
        $id = intval($_GET["id"]); // Obtener el ID de la solicitud DELETE
        delete_employee($id);
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function get_employees($id=0) {
    global $db;
    $query = "SELECT * FROM employees";
    if($id != 0) {
        $query .= " WHERE id=".$id." LIMIT 1";
    }
    $response = array();
    $stmt = $db->prepare($query);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $response[] = $row;
    }
    echo json_encode($response);
}

function add_employee() {
    global $db;
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data["name"];
    $country = $data["country"];
    $query = "INSERT INTO employees(name, country) VALUES(:name, :country)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':country', $country);
    if($stmt->execute()) {
        $response=array(
            'status' => 1,
            'status_message' =>'Employee Added Successfully.'
        );
    } else {
        $response=array(
            'status' => 0,
            'status_message' =>'Employee Addition Failed.'
        );
    }
    echo json_encode($response);
}

function update_employee($id) {
    global $db;
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data["name"];
    $country = $data["country"];
    $query = "UPDATE employees SET name=:name, country=:country WHERE id=:id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':id', $id);
    if($stmt->execute()) {
        $response=array(
            'status' => 1,
            'status_message' =>'Employee Updated Successfully.'
        );
    } else {
        $response=array(
            'status' => 0,
            'status_message' =>'Employee Updation Failed.'
        );
    }
    echo json_encode($response);
}

function delete_employee($id) {
    global $db;
    $query = "DELETE FROM employees WHERE id=".$id;
    $stmt = $db->prepare($query);
    if($stmt->execute()) {
        $response=array(
            'status' => 1,
            'status_message' =>'Employee Deleted Successfully.'
        );
    } else {
        $response=array(
            'status' => 0,
            'status_message' =>'Employee Deletion Failed.'
        );
    }
    echo json_encode($response);
}
?>
