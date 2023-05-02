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
    echo json_encode($response);


} else {
    $response['status'] = 200;
    $response['message'] = "Invalid or data not found";
}


if (isset($_POST['hiddenData'])) {
    $uniqueId = $_POST['hiddenData'];
    $f_name = $_POST['updateFName'];
    $l_name = $_POST['updateLName'];
    $status = $_POST['updateStatus'];
    $role = $_POST['updateRole'];

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
    $result = mysqli_query($con,$sql);
}
if (isset($_POST['setNotActive'])){
    $ids = $_POST['setNotActive'];
    $status = "off";
    $ids = implode(',',$ids);
    $sql="
    UPDATE `user`
    SET
        status = '$status'
    WHERE id IN ($ids)
    ";
    $result = mysqli_query($con,$sql);

}
if (isset($_POST['setActive'])){
    $ids = $_POST['setActive'];
    $status = "on";
    $ids = implode(',',$ids);
    $sql="
    UPDATE `user`
    SET
        status = '$status'
    WHERE id IN ($ids)
    ";
    $result = mysqli_query($con,$sql);

}