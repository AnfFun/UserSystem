<?php
include_once '../connect.php';

if (isset($_POST['updateId'])) {
    $userId = $_POST['updateId'];

    $sql = "
    SELECT * FROM `user`
    WHERE id='$userId'
    ";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $response = [
            'user' => $row
        ];
    }
    $response['user']['status'] = (int)$response['user']['status'];
    $response['user']['role'] = (int)$response['user']['role'];
    if ($result) {
        $response['status'] = true;
        $response['error'] = NULL;

    } else {
        $response['status'] = false;
        $response['error'] = [
            'code' => 100,
            'message' => 'User not found'
        ];



    }
    header('Content-Type: application/json');
    echo json_encode($response);

}