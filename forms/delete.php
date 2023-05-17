<?php
include_once '../connect.php';

if (isset($_POST['deleteSend'])) {
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
            'code' => 100,
            'message' => 'User not deleted'
        ];
    }
    header('Content-Type: application/json');

    echo json_encode($response);
}
