<?php

function addUser($fName, $lName, $age, $gender, $phone, $email){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://localhost/prescriptionMessenger/API/masterPatient.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "token": "'.$_SESSION['USER_TOKEN'].'",
        "action": "adduser",
        "fName": "'.$fName.'",
        "lName": "'.$lName.'",
        "age": "'.$age.'",
        "gender": "'.$gender.'",
        "phone": "'.$phone.'",
        "email": "'.$email.'"
    }',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    ));

    // DEBUGGING PURPOSES ONLY ===================================
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    // ===========================================================

    $response = curl_exec($curl);
    curl_close($curl);
    $APIResponse = json_decode($response, true);

    masterAPIResponse($APIResponse);
}

function editUser($id, $fName, $lName, $age, $gender, $phone, $email){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://localhost/prescriptionMessenger/API/masterPatient.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "token": "'.$_SESSION['USER_TOKEN'].'",
        "action": "edituser",
        "id": "'.$id.'",
        "fName": "'.$fName.'",
        "lName": "'.$lName.'",
        "age": "'.$age.'",
        "gender": "'.$gender.'",
        "phone": "'.$phone.'",
        "email": "'.$email.'"
    }',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    ));

    // DEBUGGING PURPOSES ONLY ===================================
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    // ===========================================================

    $response = curl_exec($curl);
    curl_close($curl);
    $APIResponse = json_decode($response, true);

    masterAPIResponse($APIResponse);
}

function deleteUser($id){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://localhost/prescriptionMessenger/API/masterPatient.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "token": "'.$_SESSION['USER_TOKEN'].'",
        "action": "deleteuser",
        "id": "'.$id.'"
    }',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    ));

    // DEBUGGING PURPOSES ONLY ===================================
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    // ===========================================================

    $response = curl_exec($curl);
    curl_close($curl);
    $APIResponse = json_decode($response, true);

    masterAPIResponse($APIResponse);
}

function showAll(){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://localhost/prescriptionMessenger/API/masterPatient.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "token": "'.$_SESSION['USER_TOKEN'].'",
        "action": "showall"
    }',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    ));

    // DEBUGGING PURPOSES ONLY ===================================
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    // ===========================================================

    $response = curl_exec($curl);
    curl_close($curl);
    $APIResponse = json_decode($response, true);

    // if the API returns a success then display message
    if($APIResponse['success']){
        return $APIResponse;
    }
    // if the user was not registered successfully, display error message
    elseif(!$APIResponse['success']){
        echo('
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> '.$APIResponse['message'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ');
    }
    // if none of the above took place, another error has occured which needs the aid of a developer, output appropriate message
    else{
        echo('
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> An error has occured, please contact support.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ');
    }
}

function masterAPIResponse($APIResponse){
    // if the API returns a success then display message
    if($APIResponse['success']){
        echo('
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> '.$APIResponse['message'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ');
    }
    // if the user was not registered successfully, display error message
    elseif(!$APIResponse['success']){
        echo('
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> '.$APIResponse['message'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ');
    }
    // if none of the above took place, another error has occured which needs the aid of a developer, output appropriate message
    else{
        echo('
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> An error has occured, please contact support.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ');
    }
}