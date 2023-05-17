<?php
include_once '../connect.php';

extract($_POST);

if (isset($first_name) && isset($last_name) && isset($role) && isset($status))
    if (!empty($first_name) && !empty($last_name) && !empty($role) && !empty($status)) {
        $sql = "INSERT INTO `user`
            (first_name,last_name,role,status)
        VALUES 
            ('$first_name','$last_name','$role','$status')    
        ";
        $result = mysqli_query($con, $sql);
        $id = mysqli_insert_id($con);

        if ($result) {
            $response['status'] = true;
            $response['error'] = null;
            $response['user'] = [
                'id' => $id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'role' => $role,
                'status' => $status
            ];
        } else {
            $response['status'] = false;
            $response['error'] = [
                'code' => 500,
                'message' => 'user not added'
            ];

        }

    } else {
        $response['status'] = false;
        if (empty($first_name)){
            $response['error'] = [
                'code' => 100,
                'message' => 'user not added; Please fill first-name'
            ];
        } elseif (empty($last_name)) {
            $response['error'] = [
                'code' => 100,
                'message' => 'user not added; Please last-name'
            ];
        }  elseif (empty($role)) {
            $response['error'] = [
                'code' => 100,
                'message' => 'user not added; Please fill role'
            ];
        } elseif (empty($status)) {
            $response['error'] = [
                'code' => 100,
                'message' => 'user not added; Please fill status'
            ];
        }

    }
header('Content-Type: application/json');

echo json_encode($response);


?>