<?php

try {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "musicplayer";

    $conn = new mysqli($host, $username, $password);

    if ($conn->connect_error) {
        die("Database connection unsuccesfull: " . $conn->connect_error);
    }

    $createDBQuery = "CREATE DATABASE IF NOT EXISTS $database";

    if (!$conn->query($createDBQuery)) {
        die("Error Creating Database" . $conn->error);
    }

    $conn->select_db($database);

    $createUserTableQuery = "CREATE TABLE IF NOT EXISTS user (
        userID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL,
        password VARCHAR(100) NOT NULL
    )";
    
    if (!$conn->query($createUserTableQuery)) {
        die("Error Creating User Table: " . $conn->error);
    }
    
    $createMusicTableQuery = "CREATE TABLE IF NOT EXISTS music (
        musicID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        userID INT NOT NULL,
        title VARCHAR(100) NOT NULL,
        shortdescription VARCHAR(100) NOT NULL,
        artist VARCHAR(100) NOT NULL,
        featartist VARCHAR(100),
        coverimage LONGBLOB NOT NULL,  
        audio LONGBLOB NOT NULL,      
        favorite TINYINT(1) NOT NULL DEFAULT 0,
        FOREIGN KEY (userID) REFERENCES user(userID) ON DELETE CASCADE
    )";
    
    if (!$conn->query($createMusicTableQuery)) {
        die("Error Creating Music Table: " . $conn->error);
    }

    // echo "Database created Successfully";

} catch (\Exception $e) {
    echo "Error: " . $e;
}

?>