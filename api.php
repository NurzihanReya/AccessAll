<?php
$host = 'localhost';
$db = 'SmartSociety';
$user = 'root';
$password = '';

$connection = new mysqli($host, $user, $password, $db);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$query = "SELECT name, useremail, location FROM users ";
$result = $connection->query($query);

$userData = array();
while ($row = $result->fetch_assoc()) {
    $userData[] = $row;
}

$connection->close();

header('Content-Type: application/json');
echo json_encode($userData);
?>