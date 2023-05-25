<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'user_system';
$roles = [
    1 => 'Admin',
    2 => 'User',
    3 => 'Manager',
];

try {
    $con = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error connect to DB: " . $e->getMessage());
}

?>
