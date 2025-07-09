<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: auth.php");
    exit;
}

include('config.php');
include('header.php');
?>

<main>
  <section class="admin-dashboard">
    <div class="container">
      <h1>👋 Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</h1>
      <p class="subtitle">You are logged in as <strong>Admin</strong>. Use the panel below to manage your site.</p>

      <div class="dashboard-grid">
        <div class="dashboard-card">
          <h3>🛍 Manage Products</h3>
          <p>Add, edit, or remove products from your store.</p>
          <a href="manage_products.php" class="btn-card">Go to Products</a>
        </div>

        <div class="dashboard-card">
          <h3>🎞 Manage Slider</h3>
          <p>Upload homepage slider images dynamically.</p>
          <a href="manage_slider.php" class="btn-card">Go to Slider</a>
        </div>

        <div class="dashboard-card">
          <h3>👥 View Users</h3>
          <p>Review and manage registered users.</p>
          <a href="manage_users.php" class="btn-card">Go to Users</a>
        </div>

        <div class="dashboard-card">
          <h3>🚪 Logout</h3>
          <p>End admin session and return to homepage.</p>
          <a href="logout.php" class="btn-card logout">Logout</a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include('footer.php'); ?>
