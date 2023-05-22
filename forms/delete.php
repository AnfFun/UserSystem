<?php
include_once '../connect.php';

if (isset($_POST['deleteSend'])) {
    $user_id = $_POST['deleteSend'];

    $sql = "SELECT * FROM `user` WHERE `id` = $user_id";
    $result = mysqli_query($con, $sql);
    $userExists = mysqli_num_rows($result) > 0;

    if ($userExists) {
        $sql = "DELETE FROM `user` WHERE id = '$user_id'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            $response = [
                'status' => true,
                'error' => null,
                'id' => $user_id
            ];
        } else {
            $response = [
                'status' => false,
                'error' => [
                    'code' => 500,
                    'message' => 'User not deleted, Internal server error'
                ]
            ];
        }
    } else {
        $response = [
            'status' => false,
            'error' => [
                'code' => 100,
                'error_id' => $user_id,
                'message' => "User with id: $user_id already deleted"
            ]
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
