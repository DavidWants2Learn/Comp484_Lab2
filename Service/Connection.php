<?php

$host = 'localhost';
$username = 'root';
$password ='root';
$dbname = 'mata_data';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}