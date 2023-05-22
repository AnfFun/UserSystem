<?php
include_once '../connect.php';

$response = [];

if (isset($_POST['updateId'])) {
    $user_id = $_POST['updateId'];

    $sql = "SELECT * FROM `user` WHERE `id` = $user_id";
    $result = mysqli_query($con, $sql);
    $userExists = mysqli_num_rows($result) > 0;

    if ($userExists) {
        $sql = "SELECT * FROM `user` WHERE id='$user_id'";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $response['user'] = $row;
        }

        $response['user']['status'] = (int)$response['user']['status'];
        $response['user']['role'] = (int)$response['user']['role'];

        $response['status'] = true;
        $response['error'] = null;
    } else {
        $response['status'] = false;
        $response['error'] = [
            'code' => 100,
            'errorId' => $user_id,
            'message' => "User with id: $user_id not found"
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
