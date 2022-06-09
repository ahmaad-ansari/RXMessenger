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
    || !isset($data->action)
    || !isset($data->fName)
    || !isset($data->lName)
    || !isset($data->age)
    || !isset($data->gender)
    || !isset($data->phone)
    || !isset($data->email)
    || empty(trim($data->token))
    || empty(trim($data->action))
    || empty(trim($data->fName))
    || empty(trim($data->lName))
    || empty(trim($data->age))
    || empty(trim($data->gender))
    || empty(trim($data->phone))
    || empty(trim($data->email))
) :

    $fields = ['fields' => ['token', 'action', 'fName', 'lName', 'age', 'gender', 'phone', 'email']];
    $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else :

    $token = trim($data->token);
    $action = trim($data->action);
    $fName = trim($data->fName);
    $lName = trim($data->lName);
    $age = trim($data->age);
    $gender = trim($data->gender);
    $phone = trim($data->phone);
    $email = trim($data->email);

    if (strlen($fName) < 3) :
        $returnData = msg(0, 422, 'The first name must be at least 3 characters long!');
    
    elseif (strlen($lName) < 3) :
        $returnData = msg(0, 422, 'The last name must be at least 3 characters long!');

    elseif ($age <= 0) :
        $returnData = msg(0, 422, 'The age must be greater than 0!');

    elseif ($gender != "Male" && $gender != "Female" && $gender != "Other") :
        $returnData = msg(0, 422, 'The gender must be one of the following: Male, Female, or Other!');
    
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)):
        $returnData = msg(0,422,'Invalid email address!');
    
    elseif(!$auth->isTokenValid($token)['success']) :
        $returnData = msg(0, 422, 'Expired token');

    else :
        try {

            $insert_query = "INSERT INTO `patients`(`fName`, `lName`,`age`,`gender`,`phone`,`email`) VALUES(:fName,:lName,:age,:gender,:phone,:email)";

            $insert_stmt = $conn->prepare($insert_query);

            // DATA BINDING
            $insert_stmt->bindValue(':fName', htmlspecialchars(strip_tags($fName)), PDO::PARAM_STR);
            $insert_stmt->bindValue(':lName', htmlspecialchars(strip_tags($lName)), PDO::PARAM_STR);
            $insert_stmt->bindValue(':age', htmlspecialchars(strip_tags($age)), PDO::PARAM_STR);
            $insert_stmt->bindValue(':gender', htmlspecialchars(strip_tags($gender)), PDO::PARAM_STR);
            $insert_stmt->bindValue(':phone', htmlspecialchars(strip_tags($phone)), PDO::PARAM_STR);
            $insert_stmt->bindValue(':email', htmlspecialchars(strip_tags($email)), PDO::PARAM_STR);

            $insert_stmt->execute();

            $returnData = msg(1, 201, 'Patient has been successfull successfully registered.');

        } catch (PDOException $e) {
            $returnData = msg(0, 500, $e->getMessage());
        }
    endif;
endif;

echo json_encode($returnData);