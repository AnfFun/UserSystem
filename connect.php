<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'user_system';
$roles = [
    1 => 'Admin',
    2 => 'User'
];

try {
    $con = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Помилка підключення до бази даних: " . $e->getMessage());
}

?>
