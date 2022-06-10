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

    $returnData = msg(0, 404, 'Page Not Found!');

elseif (
    !isset($data->token)
    || !isset($data->action)
    || !isset($data->id)
    || !isset($data->fName)
    || !isset($data->lName)
    || !isset($data->age)
    || !isset($data->gender)
    || !isset($data->phone)
    || !isset($data->email)
    || empty(trim($data->token))
    || empty(trim($data->action))
    || empty(trim($data->id))
    || empty(trim($data->fName))
    || empty(trim($data->lName))
    || empty(trim($data->age))
    || empty(trim($data->gender))
    || empty(trim($data->phone))
    || empty(trim($data->email))
) :

    $fields = ['fields' => ['token', 'action', 'id', 'fName', 'lName', 'age', 'gender', 'phone', 'email']];
    $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else :

    $token = trim($data->token);
    $action = trim($data->action);
    $id = trim($data->id);
    $fName = trim($data->fName);
    $lName = trim($data->lName);
    $age = trim($data->age);
    $gender = trim($data->gender);
    $phone = trim($data->phone);
    $email = trim($data->email);

    // check if token is valid first
    if (!$auth->isTokenValid($token)['success']) {
        $returnData = msg(0, 422, 'Expired token', null);
    }

    else {
        if ($action == "adduser") {
            if (strlen($fName) < 3) :
                $returnData = msg(0, 422, 'The first name must be at least 3 characters long!', null);
            
            elseif (strlen($lName) < 3) :
                $returnData = msg(0, 422, 'The last name must be at least 3 characters long!', null);
        
            elseif ($age <= 0) :
                $returnData = msg(0, 422, 'The age must be greater than 0!', null);
        
            elseif ($gender != "Male" && $gender != "Female" && $gender != "Other") :
                $returnData = msg(0, 422, 'The gender must be one of the following: Male, Female, or Other!', null);
            
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)):
                $returnData = msg(0,422,'Please provide a valid email address!', null);
        
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
        
                    $returnData = msg(1, 201, 'Patient has been successfull successfully registered.', null);
        
                } catch (PDOException $e) {
                    $returnData = msg(0, 500, $e->getMessage(), null);
                }
            endif;
        }
        
        elseif ($action == "deleteuser") {
            // check if id exists in table!!!
            if(false) :
                $returnData = msg(0, 422, 'Expired token', null);
        
            else :
                try {
                    $delete_query = "DELETE FROM `patients` WHERE id = $id";      
                    $delete_stmt = $conn->prepare($delete_query);
                    $delete_stmt->execute();
                    
                    $returnData = msg(1, 201, 'Patient has been successfull removed.', null);
        
                } catch (PDOException $e) {
                    $returnData = msg(0, 500, $e->getMessage());
                }
            endif;
        }

        elseif ($action == "edituser"){
            if (strlen($fName) < 3) :
                $returnData = msg(0, 422, 'The first name must be at least 3 characters long!', null);
            
            elseif (strlen($lName) < 3) :
                $returnData = msg(0, 422, 'The last name must be at least 3 characters long!', null);
        
            elseif ($age <= 0) :
                $returnData = msg(0, 422, 'The age must be greater than 0!', null);
        
            elseif ($gender != "Male" && $gender != "Female" && $gender != "Other") :
                $returnData = msg(0, 422, 'The gender must be one of the following: Male, Female, or Other!', null);
            
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)):
                $returnData = msg(0,422,'Invalid email address!', null);

            // check if id exists in table!!!
        
            else :
                try {
                    $update_query = "UPDATE `patients` SET fName = '$fName', lName = '$lName', age = '$age', gender = '$gender', phone = '$phone', email = '$email' WHERE id = $id";      
                    $update_stmt = $conn->prepare($update_query);
                    $update_stmt->execute();
                    
                    $returnData = msg(1, 201, 'Patient has been successfull updated.', null);
        
                } catch (PDOException $e) {
                    $returnData = msg(0, 500, $e->getMessage(), null);
                }
            endif;
        }

        elseif ($action == "showall"){
            try {
    
                $get_data = "SELECT * FROM `patients`";
                $get_data_stmt = $conn->prepare($get_data);
                $get_data_stmt->execute();
    
                if ($get_data_stmt->rowCount() <= 0) :
                    $returnData = msg(0, 422, 'No results found!', null);
    
                else :
                    $data = $get_data_stmt->fetchAll(PDO::FETCH_ASSOC);
    
                    $returnData = msg(1, 201, 'Results found!', $data);
    
                endif;
            } catch (PDOException $e) {
                $returnData = msg(0, 500, $e->getMessage(), null);
            }
        }
    }

endif;

echo json_encode($returnData);