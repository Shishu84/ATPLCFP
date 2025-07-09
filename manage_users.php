<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: auth.php");
  exit;
}
include('config.php');
include('header.php');

// Delete user if ID is passed
if (isset($_GET['delete'])) {
  $uid = intval($_GET['delete']);
  mysqli_query($conn, "DELETE FROM users WHERE id = $uid");
  header("Location: manage_users.php");
  exit;
}
?>

<main class="admin-panel">
  <div class="container">
    <h2>👥 Registered Users</h2>
    <table class="admin-table">
      <tr>
        <th>ID</th><th>Username</th><th>Email</th><th>Actions</th>
      </tr>
      <?php
      $res = mysqli_query($conn, "SELECT * FROM users");
      while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>" . htmlspecialchars($row['username']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td><a href='manage_users.php?delete={$row['id']}' class='btn-danger'>Delete</a></td>
              </tr>";
      }
      ?>
    </table>
  </div>
</main>

<?php include('footer.php'); ?>
