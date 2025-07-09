<?php
session_start();
include('config.php');

$error = '';
$success = '';

// Handle login
if (isset($_POST['login'])) {
  $username = trim($_POST['username']);
  $password = sha1(trim($_POST['password']));

  $adminQuery = $conn->prepare("SELECT id FROM admin WHERE username=? AND password=?");
  $adminQuery->bind_param('ss', $username, $password);
  $adminQuery->execute();
  $adminQuery->store_result();

  $userQuery = $conn->prepare("SELECT id FROM users WHERE username=? AND password=?");
  $userQuery->bind_param('ss', $username, $password);
  $userQuery->execute();
  $userQuery->store_result();

  if ($adminQuery->num_rows === 1) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = $username;
    header("Location: dashboard.php");
    exit;
  } elseif ($userQuery->num_rows === 1) {
    $_SESSION['user_logged_in'] = true;
    $_SESSION['user_username'] = $username;
    header("Location: index.php");
    exit;
  } else {
    $error = "Invalid credentials.";
  }
}

// Handle signup
if (isset($_POST['signup'])) {
  $username = trim($_POST['new_username']);
  $password = sha1(trim($_POST['new_password']));
  $role = $_POST['role'];

  if ($role === 'admin') {
    $insert = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
  } else {
    $insert = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
  }

  $insert->bind_param('ss', $username, $password);
  if ($insert->execute()) {
    $success = "Registration successful. You can log in now.";
  } else {
    $error = "Username already exists or error occurred.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login & Signup - MyShop</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #4e54c8, #8f94fb);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .container {
      width: 900px;
      max-width: 100%;
      background: #fff;
      border-radius: 15px;
      display: flex;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    .left {
      width: 50%;
      background: #4e54c8;
      color: white;
      padding: 50px 30px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .left h2 {
      font-size: 28px;
      margin-bottom: 20px;
    }
    .left p {
      font-size: 16px;
      line-height: 1.5;
    }
    .right {
      width: 50%;
      padding: 40px 30px;
      position: relative;
    }
    form {
      display: none;
    }
    form.active {
      display: block;
    }
    form input, form select {
      width: 100%;
      padding: 12px;
      margin: 12px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    form button {
      width: 100%;
      padding: 12px;
      background-color: #4e54c8;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: 0.3s;
    }
    form button:hover {
      background-color: #363c96;
    }
    .toggle-btns {
      text-align: center;
      margin-bottom: 20px;
    }
    .toggle-btns button {
      padding: 10px 20px;
      margin: 0 5px;
      border: none;
      background: #e0e0e0;
      border-radius: 20px;
      cursor: pointer;
    }
    .toggle-btns .active {
      background: #4e54c8;
      color: white;
    }
    .message {
      text-align: center;
      margin-bottom: 10px;
      font-weight: bold;
    }
    .success { color: green; }
    .error { color: red; }
    .back-home {
      position: absolute;
      bottom: 20px;
      left: 30px;
      text-decoration: none;
      font-size: 14px;
      color: #4e54c8;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        width: 95%;
      }
      .left, .right {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <div class="left">
    <h2>Welcome to MyShop!</h2>
    <p>Join us as a user or an admin to experience the best of e-commerce with blazing speed and simplicity. Flip to sign in or create your account today!</p>
  </div>

  <div class="right">
    <div class="toggle-btns">
      <button id="loginBtn" class="active" onclick="toggleForm('login')">Login</button>
      <button id="signupBtn" onclick="toggleForm('signup')">Signup</button>
    </div>

    <?php if (!empty($error)) echo "<p class='message error'>$error</p>"; ?>
    <?php if (!empty($success)) echo "<p class='message success'>$success</p>"; ?>

    <form id="loginForm" class="active" method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button name="login">Login</button>
    </form>

    <form id="signupForm" method="POST">
      <input type="text" name="new_username" placeholder="Username" required>
      <input type="password" name="new_password" placeholder="Password" required>
      <select name="role" required>
        <option value="user">User</option>
        <option value="admin">Admin</option>
      </select>
      <button name="signup">Register</button>
    </form>

    <a class="back-home" href="index.php">← Back to Home</a>
  </div>
</div>

<script>
  function toggleForm(type) {
    const loginBtn = document.getElementById('loginBtn');
    const signupBtn = document.getElementById('signupBtn');
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');

    if (type === 'login') {
      loginForm.classList.add('active');
      signupForm.classList.remove('active');
      loginBtn.classList.add('active');
      signupBtn.classList.remove('active');
    } else {
      signupForm.classList.add('active');
      loginForm.classList.remove('active');
      signupBtn.classList.add('active');
      loginBtn.classList.remove('active');
    }
  }
</script>

</body>
</html>
