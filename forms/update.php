<?php
include_once '../connect.php';

$response = [];

function updateUser($con, $user_id, $f_name, $l_name, $role, $status)
{
    $sql = "UPDATE `user` SET 
            first_name = :f_name,
            last_name = :l_name,
            role = :role,
            status = :status
            WHERE id = :user_id";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':f_name', $f_name,PDO::PARAM_STR);
    $stmt->bindParam(':l_name', $l_name,PDO::PARAM_STR);
    $stmt->bindParam(':role', $role,PDO::PARAM_INT);
    $stmt->bindParam(':status', $status,PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    return $stmt->execute();
}

$user_id = $_POST['hiddenData'];
$sql = "SELECT * FROM `user` WHERE `id` = :user_id";
$stmt = $con->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$userExists = $stmt->rowCount() > 0;

if (isset($_POST['hiddenData'])) {
    if ($userExists) {
        $uniqueId = $_POST['hiddenData'];
        $f_name = $_POST['updateFName'];
        $l_name = $_POST['updateLName'];
        $status = (int)$_POST['updateStatus'];
        $role = $_POST['updateRole'];

        if (!empty($f_name) && !empty($l_name) && !empty($role) && ($status === 0 || $status === 1)) {
            if (updateUser($con, $uniqueId, $f_name, $l_name, $role, $status)) {
                $response['status'] = true;
                $response['error'] = null;
                $response['user'] = [
                    'id' => $uniqueId,
                    'first_name' => $f_name,
                    'last_name' => $l_name,
                    'role' => (int)$role,
                    'role_name' => $roles[(int)$role],
                    'status' => (int)$status
                ];
            } else {
                $response['status'] = false;
                $response['error'] = [
                    'code' => 500,
                    'message' => 'User not updated, Internal server error'
                ];
            }
        } else {
            $response['status'] = false;
            if (empty($f_name)) {
                $response['error'] = [
                    'code' => 101,
                    'message' => 'User not updated, Please fill first-name'
                ];
            } elseif (empty($l_name)) {
                $response['error'] = [
                    'code' => 101,
                    'message' => 'User not updated, Please fill last-name'
                ];
            } elseif (empty($role)) {
                $response['error'] = [
                    'code' => 101,
                    'message' => 'User not updated, Please fill role'
                ];
            }
        }
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
?>
