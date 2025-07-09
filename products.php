<?php
include('config.php');
include('header.php');
?>

<main>
  <section class="product-listing">
    <h2>All Products</h2>
    <div class="product-grid">
      <?php
      $sql = "SELECT * FROM products ORDER BY id DESC";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '
            <div class="product-card">
              <img src="../assets/' . $row['image'] . '" alt="' . $row['name'] . '">
              <h3>' . $row['name'] . '</h3>
              <p>$' . $row['price'] . '</p>
              <a href="product_detail.php?id=' . $row['id'] . '" class="btn-small">View Details</a>
            </div>
          ';
        }
      } else {
        echo '<p>No products available.</p>';
      }
      ?>
    </div>
  </section>
</main>

<?php include('footer.php'); ?>
