<?php
include_once '../connect.php';

extract($_POST);

$response = [];

if (!empty($first_name) && !empty($last_name) && !empty($role) && ($status == 0 || $status == 1)) {
    $sql = "INSERT INTO `user` (first_name, last_name, role, status)
            VALUES (:first_name, :last_name, :role, :status)";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindParam(':role', $role, PDO::PARAM_INT);
    $stmt->bindParam(':status', $status, PDO::PARAM_INT);
    $result = $stmt->execute();
    $id = $con->lastInsertId();

    if ($result) {
        $response['status'] = true;
        $response['error'] = null;
        $response['user'] = [
            'id' => $id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'role' => (int)$role,
            'status' => (int)$status
        ];
    } else {
        $response['status'] = false;
        $response['error'] = [
            'code' => 500,
            'message' => 'User not added, Internal server error'
        ];
    }
} else {
    $response['status'] = false;

    if (empty($first_name)) {
        $response['error'] = [
            'code' => 101,
            'message' => 'User not added, Please fill first-name'
        ];
    } elseif (empty($last_name)) {
        $response['error'] = [
            'code' => 101,
            'message' => 'User not added, Please fill last-name'
        ];
    } elseif (empty($role)) {
        $response['error'] = [
            'code' => 101,
            'message' => 'User not added, Please fill role'
        ];
    } elseif (empty($status)) {
        $response['error'] = [
            'code' => 101,
            'message' => 'User not added, Please fill status'
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
