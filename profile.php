<?php
session_start();
include('config.php');

// Redirect if user is not logged in
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
  header("Location: login.php");
  exit;
}

// Fetch user info (if you have more user data)
$username = $_SESSION['user_username'];
$query = $conn->prepare("SELECT * FROM users WHERE username = ?");
$query->bind_param('s', $username);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Account - MyShop</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background: #eef1f5;
    }

    header {
      background: #4e54c8;
      color: white;
      padding: 20px;
      text-align: center;
    }

    .container {
      max-width: 900px;
      margin: 30px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    h2 {
      margin-bottom: 20px;
      color: #333;
    }

    .user-info {
      font-size: 16px;
      color: #555;
      line-height: 1.6;
    }

    .actions {
      margin-top: 30px;
    }

    .actions a {
      display: inline-block;
      margin-right: 10px;
      padding: 10px 20px;
      text-decoration: none;
      color: white;
      background: #4e54c8;
      border-radius: 6px;
      transition: 0.3s ease;
    }

    .actions a.logout {
      background: #e74c3c;
    }

    .actions a:hover {
      opacity: 0.9;
    }

    @media (max-width: 600px) {
      .container {
        margin: 20px;
        padding: 20px;
      }

      .actions a {
        margin-bottom: 10px;
        width: 100%;
        text-align: center;
      }
    }
  </style>
</head>
<body>

<header>
  <h1>My Account</h1>
</header>

<div class="container">
  <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>

  <div class="user-info">
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email'] ?? 'Not set'); ?></p>
    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
    <p><strong>Registered on:</strong> <?php echo isset($user['created_at']) ? date('F d, Y', strtotime($user['created_at'])) : 'N/A'; ?></p>
  </div>

  <div class="actions">
    <a href="index.php">🏠 Back to Home</a>
    <a href="logout.php" class="logout">🚪 Logout</a>
  </div>
</div>

</body>
</html>
