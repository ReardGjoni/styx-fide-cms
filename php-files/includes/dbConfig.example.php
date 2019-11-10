<?php

$host = "";
$usernm = "";
$psw = "";
$dbName = "";

$dbConnection = mysqli_connect($host, $usernm, $psw, $dbName);

if (!$dbConnection) {
    die("Connection failed: " . mysqli_connect_error());
}