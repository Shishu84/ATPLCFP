<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: auth.php");
  exit;
}
include('config.php');
include('header.php');

// Handle Add Product
if (isset($_POST['add'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $image = $_FILES['image']['name'];
  move_uploaded_file($_FILES['image']['tmp_name'], "assets/images/$image");
  mysqli_query($conn, "INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$image')");
  header("Location: manage_products.php");
  exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  mysqli_query($conn, "DELETE FROM products WHERE id = $id");
  header("Location: manage_products.php");
  exit;
}
?>

<main class="admin-panel">
  <div class="container">
    <h2>🛍 Manage Products</h2>

    <form method="post" enctype="multipart/form-data" class="admin-form">
      <input type="text" name="name" placeholder="Product Name" required>
      <input type="number" name="price" placeholder="Price" required step="0.01">
      <input type="file" name="image" required>
      <button type="submit" name="add" class="btn">Add Product</button>
    </form>

    <table class="admin-table">
      <tr>
        <th>ID</th><th>Name</th><th>Price</th><th>Image</th><th>Actions</th>
      </tr>
      <?php
      $res = mysqli_query($conn, "SELECT * FROM products");
      while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>$" . number_format($row['price'], 2) . "</td>
                <td><img src='assets/images/{$row['image']}' height='50'></td>
                <td><a href='manage_products.php?delete={$row['id']}' class='btn-danger'>Delete</a></td>
              </tr>";
      }
      ?>
    </table>
  </div>
</main>

<?php include('footer.php'); ?>
