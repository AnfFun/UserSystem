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
