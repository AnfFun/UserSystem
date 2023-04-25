<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'user_system';

$db = mysqli_connect($host,$user,$password,$dbname);

if (!$db){
    die('Database Error');
}