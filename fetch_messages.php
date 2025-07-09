<?php
include('config.php');

$sql = "SELECT sender, message, created_at FROM chat_messages ORDER BY id DESC LIMIT 20";
$result = mysqli_query($conn, $sql);

$messages = [];
while ($row = mysqli_fetch_assoc($result)) {
  $messages[] = $row;
}

echo json_encode(array_reverse($messages));
?>
