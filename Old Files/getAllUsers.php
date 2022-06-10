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

function dataMsg($success, $status, $data, $extra = [])
{
    return array_merge([
        'success' => $success,
        'status' => $status,
        'data' => $data
    ], $extra);
}

// DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));
$returnData = [];


if ($_SERVER["REQUEST_METHOD"] != "POST") :

    $returnData = msg(0, 404, 'Page Not Found!');

elseif (
    !isset($data->token)
    || !isset($data->action)
    || !isset($data->role)
    || empty(trim($data->token))
    || empty(trim($data->action))
    || empty(trim($data->role))
) :

    $fields = ['fields' => ['token', 'action', 'role']];
    $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else :

    $token = trim($data->token);
    $action = trim($data->action);
    $role = trim($data->role);

    if ($role != "Admin") :
        $returnData = msg(0, 422, 'You must be an admin to access this data!');

    elseif(!$auth->isTokenValid($token)['success']) :
        $returnData = msg(0, 422, 'Expired token');


    elseif($action = "getallemployees") :
        try {

            $get_data = "SELECT * FROM `users`";
            $get_data_stmt = $conn->prepare($get_data);
            $get_data_stmt->execute();

            if ($get_data_stmt->rowCount() <= 0) :
                $returnData = msg(0, 422, 'No results found!');

            else :
                $data = $get_data_stmt->fetchAll(PDO::FETCH_ASSOC);

                $returnData = dataMsg(1, 201, $data);

            endif;
        } catch (PDOException $e) {
            $returnData = msg(0, 500, $e->getMessage());
        }
    endif;
endif;

echo json_encode($returnData);