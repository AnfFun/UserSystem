<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'user_system';

$con = mysqli_connect($host,$user,$password,$dbname);

if (!$con){
    die(mysqli_error($con));
}