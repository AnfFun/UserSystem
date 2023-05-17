<?php
include_once '../connect.php';

if (isset($_POST['hiddenData'])) {
    $uniqueId = $_POST['hiddenData'];
    $f_name = $_POST['updateFName'];
    $l_name = $_POST['updateLName'];
    $status = $_POST['updateStatus'];
    $status = (int)$status;
    $role = $_POST['updateRole'];
    if (!empty($f_name) && !empty($l_name) && !empty($role) && (($status == 0 || $status == 1 ))) {
        $sql = "
    UPDATE `user`
    SET 
        first_name = '$f_name',
        last_name = '$l_name',
        role = '$role',
        status = '$status'
    WHERE
        id = '$uniqueId'
    ";

        $result = mysqli_query($con, $sql);

        if ($result) {
            $response['status'] = true;
            $response['error'] = null;
            $response['user'] = [
                'id' => $uniqueId,
                'first_name' => $f_name,
                'last_name' => $l_name,
                'role' => (int)$role,
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
        if (empty($f_name)){
            $response['error'] = [
                'code' => 100,
                'message' => 'User not updated, Please fill first-name'
            ];
        } elseif (empty($l_name)) {
            $response['error'] = [
                'code' => 100,
                'message' => 'User not updated, Please fill last-name'
            ];
        }  elseif (empty($role)) {
            $response['error'] = [
                'code' => 100,
                'message' => 'User not updated, Please fill role'
            ];
        }

    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

?>