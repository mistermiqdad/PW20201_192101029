<?php
    $host = 'localhost';
    $databaseName = 'db_kuliah';
    $databaseUsername = 'root';
    $databasePassword = '';

    // $mysqli = mysqli_connect($host, $databaseUsername, $databasePassword, $databaseName);
    $mysqli = new mysqli($host, $databaseUsername, $databasePassword, $databaseName);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    } 
?>