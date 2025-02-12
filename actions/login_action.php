<?php

include '../database/musicplayerDB.php';
session_start();

try {
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = verify_user($username, $password);

    if ($user) {
      $token = bin2hex(random_bytes(32));

      $_SESSION['access_token'] = $token;
      $_SESSION['userID'] = $user['userID'];
      $_SESSION['username'] = $user['username']; 
      $_SESSION['profilepicture'] = $user['profilepicture']; 

      header("Location: ../features/listenMusic.php");
      exit;
    } else {
      $_SESSION['errors'] = "Invalid username or password!";
      header("Location: ../login.php");
      exit;
    }
  }
} catch (\Exception $e) {
  echo "Error: " . $e->getMessage();
}

function verify_user($username, $password)
{
  global $conn;

  $stmt = $conn->prepare("SELECT userID, username, password FROM user WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
      return $row; // Return full user info
    }
  }
  return false;
}
?>
