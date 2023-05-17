<?php
include_once '../connect.php';

if (isset($_POST['hiddenData'])) {
    $uniqueId = $_POST['hiddenData'];
    $f_name = $_POST['updateFName'];
    $l_name = $_POST['updateLName'];
    $status = $_POST['updateStatus'];
    $role = $_POST['updateRole'];
    if (!empty($f_name) && !empty($l_name) && !empty($role) && !empty($status)) {
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
                'role' => $role,
                'status' => $status
            ];
        } else {
            $response['status'] = false;
            $response['error'] = [
                'code' => 500,
                'message' => 'user not updated'
            ];
        }
    } else {
        $response['status'] = false;
        if (empty($f_name)){
            $response['error'] = [
                'code' => 100,
                'message' => 'user not updated; Please fill first-name'
            ];
        } elseif (empty($l_name)) {
            $response['error'] = [
                'code' => 100,
                'message' => 'user not updated; Please fill last-name'
            ];
        }  elseif (empty($role)) {
            $response['error'] = [
                'code' => 100,
                'message' => 'user not updated; Please fill role'
            ];
        } elseif (empty($status)) {
            $response['error'] = [
                'code' => 100,
                'message' => 'user not updated; Please fill status'
            ];
        }

    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

?>