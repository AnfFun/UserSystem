<?php
include_once '../connect.php';

extract($_POST);

if (isset($_POST['first_name']) && isset($_POST['last_name'])) {
    if (empty($first_name) || empty($last_name) || empty($role) || empty($status)) {
       die();
    } else {
        $sql = "INSERT INTO `user`
            (first_name,last_name,role,status)
        VALUES 
            ('$first_name','$last_name','$role','$status')    
        ";
        $result = mysqli_query($con, $sql);
    }
}
?>