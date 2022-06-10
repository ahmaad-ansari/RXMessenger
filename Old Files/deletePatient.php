<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__ . '/classes/Database.php';
require __DIR__ . '/AuthMiddleware.php';

$allHeaders = getallheaders();
$db_connection = new Database();
$conn = $db_connection->dbConnection();
$auth = new Auth($conn, $allHeaders);

function msg($success, $status, $message, $extra = [])
{
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ], $extra);
}

// DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));
$returnData = [];

if ($_SERVER["REQUEST_METHOD"] != "POST") :

    $returnData = msg(0, 404, 'Page Not Found!');

elseif (
    !isset($data->token)
    || !isset($data->id)
    || empty(trim($data->token))
    || empty(trim($data->id))
) :

    $fields = ['fields' => ['token', 'id']];
    $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else :

    $token = trim($data->token);
    $id = trim($data->id);

    
    if(!$auth->isTokenValid($token)['success']) :
        $returnData = msg(0, 422, 'Expired token');

    else :
        try {
            $delete_query = "DELETE FROM `patients` WHERE id = $id";      
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->execute();
            
            $returnData = msg(1, 201, 'Patient has been successfull removed.');

        } catch (PDOException $e) {
            $returnData = msg(0, 500, $e->getMessage());
        }
    endif;
endif;

echo json_encode($returnData);