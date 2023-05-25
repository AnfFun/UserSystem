<?php
include_once '../connect.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deleteSend'])) {
        $user_id = $_POST['deleteSend'];

        $sql = "SELECT * FROM `user` WHERE `id` = :user_id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $userExists = $stmt->rowCount() > 0;

        if ($userExists) {
            $sql = "DELETE FROM `user` WHERE id = :user_id";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $result = $stmt->execute();

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
    } else {
        $response = [
            'status' => false,
            'error' => [
                'code' => 400,
                'message' => 'Invalid request'
            ]
        ];
    }
} else {
    $response = [
        'status' => false,
        'error' => [
            'code' => 400,
            'message' => 'Invalid request method'
        ]
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
