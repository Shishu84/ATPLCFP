<?php
// Start session if not started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('config.php');

// Check login states
$isAdminLoggedIn = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
$isUserLoggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MyShop</title>
    <!-- Link external CSS -->
    <link rel="stylesheet" href="style.css" />

    <!-- Additive inline enhancements -->
    <style>
      body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        transition: font-size 0.3s ease;
      }

      .top-header {
        background: #333;
        color: white;
        padding: 10px 0;
        font-size: 14px;
      }

      .header-tools {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: auto;
        padding: 0 20px;
      }

      .font-controls button {
        background: #fff;
        color: #333;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: bold;
        margin-left: 5px;
        transition: transform 0.2s ease;
      }

      .font-controls button:hover {
        transform: scale(1.1);
      }

      .navbar {
        background: #f8f8f8;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
      }

      .navbar .container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        padding: 10px 20px;
      }

      .logo {
        font-size: 24px;
        font-weight: bold;
        color: #e74c3c;
        text-decoration: none;
      }

      .nav-links {
        list-style: none;
        padding: 0;
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
      }

      .nav-links a {
        text-decoration: none;
        color: #333;
        font-weight: 500;
        transition: color 0.3s;
      }

      .nav-links a:hover {
        color: #e74c3c;
      }

      .slider {
        margin-top: 10px;
        overflow: hidden;
      }

      .slides {
        display: flex;
        overflow-x: auto;
        scroll-behavior: smooth;
      }

      .slide {
        flex: 0 0 100%;
        max-height: 300px;
      }

      .slide img {
        width: 100%;
        height: auto;
        display: block;
      }

      @media screen and (max-width: 768px) {
        .nav-links {
          flex-direction: column;
          background: #f2f2f2;
          padding: 10px;
          display: none;
        }

        .nav-links.open {
          display: flex;
        }

        .menu-toggle {
          display: block;
          background: #e74c3c;
          color: #fff;
          border: none;
          padding: 10px;
          font-size: 16px;
          cursor: pointer;
          border-radius: 4px;
        }
      }

      .menu-toggle {
        display: none;
      }
    </style>
</head>
<body>

<!-- HEADER BAR -->
<header class="top-header">
  <div class="container header-tools">
    <div id="live-time" class="live-time">Loading time...</div>
    <div class="font-controls">
      <button onclick="adjustFont('+')" aria-label="Increase font size">A+</button>
      <button onclick="adjustFont('-')" aria-label="Decrease font size">A-</button>
    </div>
  </div>
</header>

<!-- NAVIGATION -->
<nav class="navbar">
  <div class="container">
    <a href="index.php" class="logo">MyShop</a>
    <button class="menu-toggle" onclick="toggleMenu()">&#9776; Menu</button>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="products.php">Products</a></li>
      <li class="auth-links" style="margin-left:auto;">
        <?php if ($isAdminLoggedIn): ?>
          <a href="dashboard.php">Admin Dashboard</a> |
          <a href="logout.php">Logout</a>
        <?php else: ?>
          <a href="auth.php">Login / Signup</a>
        <?php endif; ?>
      </li>
      <li class="auth-links">
        <?php if ($isUserLoggedIn): ?>
          <a href="profile.php">My Account</a> |
          <a href="logout.php">Logout</a>
        <?php else: ?>
          <a href="login.php">User Login</a>
        <?php endif; ?>
      </li>
    </ul>
  </div>
</nav>



  

<!-- JavaScript for interactivity -->
<script>
  // Live time update
  function updateTime() {
    const liveTime = document.getElementById('live-time');
    if (liveTime) {
      const now = new Date();
      liveTime.textContent = now.toLocaleString();
    }
  }
  setInterval(updateTime, 1000);
  updateTime();

  // Font size adjustment
  function adjustFont(action) {
    const body = document.body;
    const style = window.getComputedStyle(body, null).getPropertyValue('font-size');
    let fontSize = parseFloat(style);
    if (action === '+') fontSize += 1;
    else if (action === '-') fontSize -= 1;
    if (fontSize >= 12 && fontSize <= 24) body.style.fontSize = fontSize + 'px';
  }

  // Toggle menu
  function toggleMenu() {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('open');
  }


  
const track = document.getElementById('sliderTrack');
track.addEventListener('mouseenter', () => {
  track.style.animationPlayState = 'paused';
});
track.addEventListener('mouseleave', () => {
  track.style.animationPlayState = 'running';
});


</script>
