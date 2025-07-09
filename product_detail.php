<?php
include('config.php');
include('header.php');

// Get product ID safely
$product_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Fetch product details
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);
?>

<main>
  <section class="product-detail-section">
    <?php if ($product): ?>
      <div class="product-detail-container">
        <div class="product-detail-image">
          <img src="../assets/<?= $product['image']; ?>" alt="<?= htmlspecialchars($product['name']); ?>">
        </div>
        <div class="product-detail-info">
          <h1><?= htmlspecialchars($product['name']); ?></h1>
          <p class="price">$<?= number_format($product['price'], 2); ?></p>
          <p class="description"><?= nl2br(htmlspecialchars($product['description'])); ?></p>

          <!-- Add to Cart Button (non-functional for now) -->
          <form method="post" action="cart.php">
  <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
  <label>Qty:</label>
  <input type="number" name="quantity" value="1" min="1" required>
  <button class="btn btn-primary">Add to Cart</button>
</form>

        </div>
      </div>
    <?php else: ?>
      <p style="text-align:center; font-size:18px;">Product not found.</p>
    <?php endif; ?>
  </section>
</main>

<?php include('footer.php'); ?>
