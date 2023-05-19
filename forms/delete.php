<?php
include_once '../connect.php';

if (isset($_POST['deleteSend'])) {
    $user_id = $_POST['deleteSend'];
    $sql = "SELECT * FROM `user` WHERE `id` = $user_id";
    $result = mysqli_query($con, $sql);
    $userExists = mysqli_num_rows($result) > 0;
    if ($userExists) {
        $unique = $_POST['deleteSend'];

        $sql = "
    DELETE FROM `user`
    WHERE
        id = '$unique'
    ";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $response['status'] = true;
            $response['error'] = null;
            $response['id'] = $unique;
        } else {
            $response['status'] = false;
            $response['error'] = [
                'code' => 500,
                'message' => 'User not deleted, Internal server error'
            ];
        }
    } else{
        $response['status'] = false;
        $response['error'] = [
            'code' => 100,
            'message' => 'User already deleted'
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
