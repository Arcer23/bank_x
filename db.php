<?php
$conn = new mysqli("localhost", "arcer", "pass123", "auth_db");

if ($conn->connect_error) {
    die("conection failed " . $conn->connect_error);
}
?>