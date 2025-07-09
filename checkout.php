<?php
session_start();
include('config.php');
include('header.php');

// Ensure cart is not empty
if (empty($_SESSION['cart'])) {
  echo "<p style='text-align:center; padding:40px;'>Your cart is empty. <a href='products.php'>Shop Now</a></p>";
  include('../includes/footer.php');
  exit;
}

// Handle form submission (no DB save, just a thank you message for now)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $address = htmlspecialchars($_POST['address']);
  
  // Clear cart after order (simulate success)
  $_SESSION['cart'] = [];

  echo "<main style='padding:40px; text-align:center;'>
    <h2>🎉 Thank You, $name!</h2>
    <p>Your order has been placed. We will contact you at <strong>$email</strong>.</p>
    <a href='index.php' class='btn btn-primary'>Return to Home</a>
  </main>";
  
  include('footer.php');
  exit;
}
?>

<main>
  <section class="checkout-section">
    <h2>🛒 Checkout</h2>

    <!-- Order Summary -->
    <div class="order-summary">
      <h3>Order Summary</h3>
      <ul>
        <?php
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
          $subtotal = $item['price'] * $item['quantity'];
          $total += $subtotal;
          echo "<li>{$item['name']} x {$item['quantity']} - $".number_format($subtotal,2)."</li>";
        }
        ?>
      </ul>
      <p><strong>Total: $<?= number_format($total, 2); ?></strong></p>
    </div>

    <!-- Checkout Form -->
    <form method="post" class="checkout-form">
      <h3>Enter Your Details</h3>
      <label>Full Name:</label>
      <input type="text" name="name" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Shipping Address:</label>
      <textarea name="address" rows="3" required></textarea>

      <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
  </section>
</main>

<?php include('footer.php'); ?>
