<?php
include_once '../connect.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['updateId'])) {
        $user_id = $_POST['updateId'];

        $sql = "SELECT * FROM `user` WHERE `id` = :user_id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $userExists = $row !== false;

        if ($userExists) {
            $response['user'] = $row;
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
    } else {
        $response['status'] = false;
        $response['error'] = [
            'code' => 400,
            'message' => 'Invalid request'
        ];
    }
} else {
    $response['status'] = false;
    $response['error'] = [
        'code' => 400,
        'message' => 'Invalid request method'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
