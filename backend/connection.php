<?php

$servername = "localhost";
$username = "root";
$password = "@admin1230997";
$database = "pinoycravings";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


