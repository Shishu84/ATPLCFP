<?php
include ('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $sender = 'User'; 
  $message = trim($_POST['message']);

  if ($message !== '') {
    $stmt = $conn->prepare("INSERT INTO chat_messages (sender, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $sender, $message);
    $stmt->execute();
  }
}
?>
