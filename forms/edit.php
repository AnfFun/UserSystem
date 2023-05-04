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

    } else {
        $response['response'] = 500;


    }
    echo json_encode($response);

}