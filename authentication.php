<?php

    require __DIR__ . '/API Functions/API_login.php';

    // check if token is authenticated and if user has access to page
    try{
        $APIResponse = getCurrentUser();

        // token is valid
        if ($APIResponse['success']){
            return 1;
        }
        // display login page
        else{
            header('Location: login.php');
            exit;
        }
    }
    catch(PDOException $e){
        echo($e->getMessage());
    }
   

    function userHasAdminAccess(){
        try{
            $APIResponse = getCurrentUser();
            // user is admin
            if($APIResponse['user']['role'] == "Admin"){
                return 1;
            }
            // display login page
            else{
                header('Location: invalidAccess.php');
                exit;
            }
        }
        catch(PDOException $e){
            echo($e->getMessage());
        }
    }

