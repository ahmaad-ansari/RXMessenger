<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/patients.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$patient = new Patient($db);
  
// query patient
$stmt = $patient->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num > 0){
  
    // patient array
    $patient_arr = array();
    $patient_arr["records"] = array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $patient_information=array(
            "id"            => $id,
            "name"          => $name,
            "description"   => html_entity_decode($description),
            "price"         => $price,
            "category_id"   => $category_id,
            "category_name" => $category_name
        );
  
        array_push($patient_arr["records"], $patient_information);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show patient data in json format
    echo json_encode($patient_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No patients found.")
    );
}