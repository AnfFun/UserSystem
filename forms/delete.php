<?php
include_once '../connect.php';

if (isset($_POST['deleteSend'])) {
    $unique = $_POST['deleteSend'];

    $sql = "
    DELETE FROM `user`
    WHERE
        id = '$unique'
    ";
    $result = mysqli_query($con,$sql);
    if ($result) {
        $response['status'] = 200;
    } else {
        $response['status'] = 500;
    }
    echo json_encode($response);
}

if (isset($_POST['setDelete'])){
    $ids = $_POST['setDelete'];
    $ids = implode(',',$ids);
    $sql= "
    DELETE FROM `user`
    WHERE id IN ($ids)
    ";
    $result = mysqli_query($con,$sql);
}
