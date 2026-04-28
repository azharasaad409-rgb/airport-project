<?php
$host = 'sql112.infinityfree.com';
$user = 'if0_41779070';
$pass = 'Azharasaad123';
$db   = 'if0_41779070_airport';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
