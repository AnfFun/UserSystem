<?php
include_once '../connect.php';

extract($_POST);

if (isset($first_name) && isset($last_name) && isset($role) && isset($status))
    if (!empty($first_name) && !empty($last_name) && !empty($role)) {
        $sql = "INSERT INTO `user`
            (first_name,last_name,role,status)
        VALUES 
            ('$first_name','$last_name','$role','$status')    
        ";
        $result = mysqli_query($con, $sql);

        if ($result) {
            $response['status'] = 200;;
        } else {
            $response['status'] = 500;
        }

    } else {
        $response['status'] = 422;
    }

echo json_encode($response);


?>