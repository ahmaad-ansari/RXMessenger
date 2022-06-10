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

function msg($success, $status, $message, $data, $extra = [])
{
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message,
        'data' => $data
    ], $extra);
}

// DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));
$returnData = [];

if ($_SERVER["REQUEST_METHOD"] != "POST") :

    $returnData = msg(0, 404, 'Page Not Found!', null);

elseif (
    !isset($data->token)
    || !isset($data->action)
    || !isset($data->fName)
    || !isset($data->lName)
    || !isset($data->username)
    || !isset($data->password)
    || !isset($data->role)
    || !isset($data->company)
    || empty(trim($data->token))
    || empty(trim($data->fName))
    || empty(trim($data->lName))
    || empty(trim($data->username))
    || empty(trim($data->password))
    || empty(trim($data->role))
    || empty(trim($data->company))
) :

    $fields = ['fields' => ['token', 'action', 'fName', 'lName', 'username', 'password', 'role', 'company']];
    $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields, null);

// IF THERE ARE NO EMPTY FIELDS THEN-
else :

    $token = trim($data->token);
    $action = trim($data->action);
    $fName = trim($data->fName);
    $lName = trim($data->lName);
    $username = trim($data->username);
    $password = trim($data->password);
    $role = trim($data->role);
    $company = trim($data->company);

    // check if token is valid
    if (!$auth->isTokenValid($token)['success']) {
        $returnData = msg(0, 422, 'Expired token', null);
    }

    else { 
        if($action == "adduser"){
            if (strlen($username) < 5) :
                $returnData = msg(0, 422, 'Your username must be at least 5 characters long!', null);
    
            elseif (strlen($password) < 8) :
                $returnData = msg(0, 422, 'Your password must be at least 8 characters long!', null);
    
            elseif (strlen($fName) < 3) :
                $returnData = msg(0, 422, 'Your first name must be at least 3 characters long!', null);
            
            elseif (strlen($lName) < 3) :
                $returnData = msg(0, 422, 'Your last name must be at least 3 characters long!', null);
    
            else :
                try {
    
                    $check_username = "SELECT `username` FROM `users` WHERE `username`=:username";
                    $check_username_stmt = $conn->prepare($check_username);
                    $check_username_stmt->bindValue(':username', $username, PDO::PARAM_STR);
                    $check_username_stmt->execute();
    
                    if ($check_username_stmt->rowCount()) :
                        $returnData = msg(0, 422, 'This username is already in use!', null);
    
                    else :
                        $insert_query = "INSERT INTO `users`(`fName`, `lName`,`username`,`password`,`role`,`company`) VALUES(:fName,:lName,:username,:password,:role,:company)";
    
                        $insert_stmt = $conn->prepare($insert_query);
    
                        // DATA BINDING
                        $insert_stmt->bindValue(':fName', htmlspecialchars(strip_tags($fName)), PDO::PARAM_STR);
                        $insert_stmt->bindValue(':lName', htmlspecialchars(strip_tags($lName)), PDO::PARAM_STR);
                        $insert_stmt->bindValue(':username', $username, PDO::PARAM_STR);
                        $insert_stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
                        $insert_stmt->bindValue(':role', htmlspecialchars(strip_tags($role)), PDO::PARAM_STR);
                        $insert_stmt->bindValue(':company', htmlspecialchars(strip_tags($company)), PDO::PARAM_STR);
    
                        $insert_stmt->execute();
    
                        $returnData = msg(1, 201, 'You have successfully registered.', null);
    
                    endif;
                } catch (PDOException $e) {
                    $returnData = msg(0, 500, $e->getMessage(), null);
                }
            endif;
        }

        elseif($action == "showall"){
            if ($role != "Admin") :
                $returnData = msg(0, 422, 'You must be an admin to access this data!', null);
             
            else :
                try {
                    $get_data = "SELECT * FROM `users`";
                    $get_data_stmt = $conn->prepare($get_data);
                    $get_data_stmt->execute();
        
                    if ($get_data_stmt->rowCount() <= 0) :
                        $returnData = msg(0, 422, 'No results found!', null);
        
                    else :
                        $data = $get_data_stmt->fetchAll(PDO::FETCH_ASSOC);
        
                        $returnData = msg(1, 201, "Results found!", $data);
        
                    endif;
                } catch (PDOException $e) {
                    $returnData = msg(0, 500, $e->getMessage(), null);
                }
            endif;
        }
    }
endif;

echo json_encode($returnData);