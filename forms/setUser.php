<?php
include_once '../connect.php';

if (isset($_POST['setNotActive'])) {
    $ids = $_POST['setNotActive'];
    $status = "off";
    $ids = implode(',', $ids);
    $sql = "
    UPDATE `user`
    SET
        status = '$status'
    WHERE id IN ($ids)
    ";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $response['response'] = 200;


    } else {
        $response['response'] = 500;

    }
    echo json_encode($response);
}
if (isset($_POST['setActive'])) {
    $ids = $_POST['setActive'];
    $status = "on";
    $ids = implode(',', $ids);
    $sql = "
    UPDATE `user`
    SET
        status = '$status'
    WHERE id IN ($ids)
    ";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $response['response'] = 200;
    } else {
        $response['response'] = 500;

    }
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
        $response['response'] = 200;


    } else {
        $response['response'] = 500;

    }
    echo json_encode($response);

}