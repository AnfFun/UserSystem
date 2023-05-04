<?php
include_once '../connect.php';

//extract($_POST);
if (isset($_POST['hiddenData'])) {
    $uniqueId = $_POST['hiddenData'];
    $f_name = $_POST['updateFName'];
    $l_name = $_POST['updateLName'];
    $status = $_POST['updateStatus'];
    $role = $_POST['updateRole'];
    if (!empty($f_name) && !empty($l_name) && !empty($role)) {
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
            $response['status'] = 200;
        } else {
            $response['status'] = 500;
        }
    } else {
        $response['status'] = 422;


    }
    echo json_encode($response);
}



?>