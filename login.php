<?php
session_start();
include('config.php');

// Redirect if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === '' || $password === '') {
        $error = "Please enter both username and password.";
    } else {
        $hashed_password = sha1($password);

        $stmt = $conn->prepare("SELECT id FROM admin WHERE username = ? AND password = ?");
        $stmt->bind_param('ss', $username, $hashed_password);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid username or password.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Login - MyShop</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        body {
            background: #f4f7f8;
            font-family: Arial, sans-serif;
        }
        .admin-login {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .admin-login h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        .admin-login label {
            display: block;
            margin: 15px 0 5px;
            font-weight: bold;
        }
        .admin-login input[type="text"],
        .admin-login input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .admin-login button {
            width: 100%;
            padding: 12px;
            margin-top: 25px;
            background-color: #007bff;
            color: white;
            border: none;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .admin-login button:hover {
            background-color: #0056b3;
        }
        .error-msg {
            color: red;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="admin-login">
    <h2> Login</h2>
    <?php if ($error): ?>
        <p class="error-msg"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label>Username:</label>
        <input type="text" name="username" required autofocus />
        <label>Password:</label>
        <input type="password" name="password" required />
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
