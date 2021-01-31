<?php
    $host = 'localhost';
    $databaseName = 'db_kuliah';
    $databaseUsername = 'root';
    $databasePassword = '';

    $mysqli = new mysqli($host, $databaseUsername, $databasePassword, $databaseName);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    } 
?>