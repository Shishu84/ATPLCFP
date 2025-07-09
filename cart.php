<?php
session_start();
include('config.php');


// Handle Add to Cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
  $id = (int) $_POST['product_id'];
  $quantity = isset($_POST['quantity']) ? max(1, (int)$_POST['quantity']) : 1;

  // Fetch product info
  $result = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
  $product = mysqli_fetch_assoc($result);

  if ($product) {
    $item = [
      'id' => $product['id'],
      'name' => $product['name'],
      'price' => $product['price'],
      'image' => $product['image'],
      'quantity' => $quantity
    ];

    // Add/update session cart
    $_SESSION['cart'][$id] = $item;
  }

  header("Location: cart.php");
  exit;
}

// Handle Remove
if (isset($_GET['remove'])) {
  $rid = (int)$_GET['remove'];
  unset($_SESSION['cart'][$rid]);
  header("Location: cart.php");
  exit;
}
include('header.php');
?>

<main>
  <section class="cart-section">
    <h2>Your Cart</h2>
    <?php if (!empty($_SESSION['cart'])): ?>
      <table class="cart-table">
        <thead>
          <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Subtotal</th>
            <th>Remove</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $total = 0;
          foreach ($_SESSION['cart'] as $item):
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
          ?>
            <tr>
              <td><img src="../assets/images/<?= $item['image']; ?>" width="50"></td>
              <td><?= htmlspecialchars($item['name']); ?></td>
              <td>$<?= number_format($item['price'], 2); ?></td>
              <td><?= $item['quantity']; ?></td>
              <td>$<?= number_format($subtotal, 2); ?></td>
              <td><a href="?remove=<?= $item['id']; ?>" class="remove-btn">✕</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4" align="right"><strong>Total:</strong></td>
            <td colspan="2"><strong>$<?= number_format($total, 2); ?></strong></td>
          </tr>
        </tfoot>
      </table>
    <?php else: ?>
      <p class="empty-cart">Your cart is empty.</p>
    <?php endif; ?>
  </section>
</main>

<?php include('footer.php'); ?>
