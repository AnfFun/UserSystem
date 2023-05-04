<?php
include_once '../connect.php';

if (isset($_POST['updateId'])) {
    $userId = $_POST['updateId'];

    $sql = "
    SELECT * FROM `user`
    WHERE id='$userId'
    ";
    $result = mysqli_query($con, $sql);
    $response = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $response = $row;

    }
    if ($result) {
        $response['response'] = 200;
        echo json_encode($response);
    } else {
        $response['response'] = 500;
        echo json_encode($response);

    }

}


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

}