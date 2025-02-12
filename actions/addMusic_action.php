<?php
session_start();
include "../database/musicplayerDB.php";

try {
    if (!isset($_SESSION['userID'])) {
        echo "User not logged in.";
        exit;
    }

    $userID = $_SESSION['userID'];

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $title = $_POST['title'];
        $shortdescription = $_POST['shortdescription'];
        $artist = $_POST['artist'];
        $featartist = $_POST['featartist'];
        $favorite = isset($_POST['favorite']) ? 1 : 0;

        // Cover Image Upload
        $coverImagePath = 'images/';
        if (!is_dir($coverImagePath)) {
            mkdir($coverImagePath, 0777, true);
        }

        if (isset($_FILES['coverimage']) && $_FILES['coverimage']['error'] == UPLOAD_ERR_OK) {
            $coverImageTmpName = $_FILES['coverimage']['tmp_name'];
            $coverImageName = basename($_FILES['coverimage']['name']);
            $coverImagePath .= $coverImageName;

            if (!move_uploaded_file($coverImageTmpName, $coverImagePath)) {
                echo "Error uploading cover image.";
                exit;
            }
        } else {
            echo "No cover image uploaded.";
            exit;
        }

        // Audio Upload
        $audioPath = 'audio/';
        if (!is_dir($audioPath)) {
            mkdir($audioPath, 0777, true);
        }

        if (isset($_FILES['audio']) && $_FILES['audio']['error'] == UPLOAD_ERR_OK) {
            $audioTmpName = $_FILES['audio']['tmp_name'];
            $audioName = basename($_FILES['audio']['name']);
            $audioPath .= $audioName;

            if (!move_uploaded_file($audioTmpName, $audioPath)) {
                echo "Error uploading audio.";
                exit;
            }
        } else {
            echo "No audio file uploaded.";
            exit;
        }

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO music (userID, title, shortdescription, artist, featartist, coverimage, audio, favorite) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssi", $userID, $title, $shortdescription, $artist, $featartist, $coverImagePath, $audioPath, $favorite);

        if ($stmt->execute()) {
            header("Location: ../features/listenMusic.php");
            exit;
        } else {
            echo "Operation Failed: " . $stmt->error;
        }
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
