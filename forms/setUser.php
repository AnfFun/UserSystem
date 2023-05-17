<?php
include_once '../connect.php';

if (isset($_POST['setNotActive'])) {
    $ids = $_POST['setNotActive'];
    $status = 0;
    $ids = implode(',', $ids);
    $sql = "
    UPDATE `user`
    SET
        status = '$status'
    WHERE id IN ($ids)
    ";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $response['status'] = true;
        $response['error'] = null;
        $response['users'] = [
            'id' => $ids
        ];




    } else {
        $response['status'] = false ;
        $response['error'] = [
            'code' => 100,
            'message' => 'Status not changed'
        ];


    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
if (isset($_POST['setActive'])) {
    $ids = $_POST['setActive'];
    $status = 1;
    $ids = implode(',', $ids);
    $sql = "
    UPDATE `user`
    SET
        status = '$status'
    WHERE id IN ($ids)
    ";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $response['status'] = true;
        $response['error'] = null;
        $response['users'] = [
            'id' => $ids
        ];
    } else {
        $response['status'] = false ;
        $response['error'] = [
            'code' => 100,
            'message' => 'Status not changed'
        ];


    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
if (isset($_POST['setDelete'])) {
    $ids = $_POST['setDelete'];
    $ids = implode(',', $ids);
    $sql = "
    DELETE FROM `user`
    WHERE id IN ($ids)
    ";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $response['status'] = true;
        $response['error'] = null;
        $response['users'] = [
            'id' => $ids
        ];
    } else {
        $response['status'] = false ;
        $response['error'] = [
            'code' => 100,
            'message' => 'Users not deleted'
        ];


    }
    header('Content-Type: application/json');
    echo json_encode($response);

}