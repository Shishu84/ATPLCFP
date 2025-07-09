<?php
session_start();
include('config.php');
include('header.php');

$isAdminLoggedIn = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
$isUserLoggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>MyShop - Home</title>
  <style>
    /* ===== HERO SECTION ===== */
    body {
      margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f9fafb;
      color: #2c2c54;
    }
    .hero-section {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      background: linear-gradient(135deg, #4e54c8, #8f94fb);
      color: white;
      padding: 60px 40px;
      border-radius: 20px;
      margin: 30px auto;
      max-width: 1200px;
      box-shadow: 0 10px 40px rgba(78, 84, 200, 0.3);
    }
    .hero-text {
      flex: 1 1 500px;
      max-width: 600px;
    }
    .hero-text h1 {
      font-size: 3.8rem;
      font-weight: 900;
      margin-bottom: 20px;
      line-height: 1.1;
      text-shadow: 2px 2px 8px rgba(0,0,0,0.2);
    }
    .hero-text .highlight {
      color: #ffd700;
      text-shadow: 0 0 10px #ffd700aa;
    }
    .hero-text p {
      font-size: 1.4rem;
      margin-bottom: 30px;
      color: #e0e0ff;
    }
    .btn-primary {
      background-color: #ffd700;
      color: #2c2c54;
      font-weight: 700;
      padding: 16px 38px;
      border-radius: 50px;
      box-shadow: 0 6px 20px rgba(255, 215, 0, 0.5);
      text-decoration: none;
      transition: all 0.3s ease;
      display: inline-block;
      letter-spacing: 1px;
    }
    .btn-primary:hover {
      background-color: #fff14f;
      box-shadow: 0 8px 28px rgba(255, 215, 0, 0.8);
      color: #1a1a3d;
    }
    .hero-image {
      flex: 1 1 400px;
      max-width: 450px;
      text-align: center;
    }
    .hero-image img {
      width: 100%;
      border-radius: 30px;
      box-shadow: 0 20px 50px rgba(0,0,0,0.15);
      transition: transform 0.5s ease;
    }
    .hero-image img:hover {
      transform: translateY(-15px) scale(1.05);
    }

    /* ===== FEATURED PRODUCTS ===== */
    .featured-section {
      text-align: center;
      margin: 60px auto;
      max-width: 1200px;
    }
    .section-title {
      font-size: 3rem;
      font-weight: 900;
      margin-bottom: 8px;
      color: #4e54c8;
      letter-spacing: 1.5px;
      text-shadow: 0 1px 2px rgba(78, 84, 200, 0.4);
    }
    .section-subtitle {
      font-size: 1.25rem;
      color: #7777aa;
      margin-bottom: 40px;
    }
    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 32px;
      padding: 0 20px;
    }
    .product-card {
      background: #fff;
      border-radius: 25px;
      box-shadow: 0 10px 30px rgba(78, 84, 200, 0.15);
      overflow: hidden;
      display: flex;
      flex-direction: column;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .product-card:hover {
      transform: translateY(-15px);
      box-shadow: 0 15px 50px rgba(78, 84, 200, 0.3);
    }
    .product-image img {
      width: 100%;
      height: 230px;
      object-fit: cover;
      border-bottom: 4px solid #4e54c8;
      transition: transform 0.4s ease;
    }
    .product-card:hover .product-image img {
      transform: scale(1.07);
    }
    .product-info {
      padding: 20px 25px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .product-info h3 {
      font-size: 1.3rem;
      font-weight: 700;
      margin-bottom: 10px;
      color: #2c2c54;
    }
    .price {
      font-size: 1.1rem;
      font-weight: 700;
      color: #555;
      margin-bottom: 20px;
    }
    .btn-view {
      background-color: #4e54c8;
      color: #fff;
      text-decoration: none;
      font-weight: 700;
      padding: 12px 24px;
      border-radius: 40px;
      box-shadow: 0 8px 22px rgba(78, 84, 200, 0.5);
      transition: background-color 0.3s ease;
      align-self: flex-start;
    }
    .btn-view:hover {
      background-color: #2f33a6;
      box-shadow: 0 12px 32px rgba(47, 51, 166, 0.7);
    }
    .no-products {
      font-size: 1.2rem;
      color: #999;
      font-style: italic;
      margin-top: 50px;
    }

    /* RESPONSIVE */
    @media (max-width: 992px) {
      .hero-section {
        flex-direction: column;
        text-align: center;
        padding: 40px 20px;
      }
      .hero-text {
        max-width: 100%;
        margin-bottom: 30px;
      }
      .hero-image {
        max-width: 90%;
      }
    }
    @media (max-width: 576px) {
      .hero-text h1 {
        font-size: 2.5rem;
      }
      .btn-primary {
        padding: 14px 28px;
        font-size: 16px;
      }
      .product-grid {
        grid-template-columns: 1fr;
      }
      .product-info h3 {
        font-size: 1.15rem;
      }
    }
  </style>
</head>
<body>

<main>

  <!-- HERO SECTION -->
  <section class="hero-section">
    <div class="hero-container">
      <div class="hero-text">
        <h1>Welcome to <span class="highlight">MyShop</span></h1>
        <p>Your destination for trendy, reliable, and affordable products.</p>
        <a href="products.php" class="btn btn-primary">Start Shopping</a>
      </div>
      <div class="hero-image">
        <img src="hero.png" alt="Hero Image" />
      </div>
    </div>
  </section>

  <!-- FEATURED PRODUCTS -->
  <section class="featured-section">
    <h2 class="section-title">🔥 Featured Products</h2>
    <p class="section-subtitle">Carefully selected just for you!</p>

    <div class="product-grid">
      <?php
      $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 6";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '
            <div class="product-card">
              <div class="product-image">
                <img src="../assets/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '" />
              </div>
              <div class="product-info">
                <h3>' . htmlspecialchars($row['name']) . '</h3>
                <p class="price">$' . number_format($row['price'], 2) . '</p>
                <a href="product_detail.php?id=' . $row['id'] . '" class="btn-view">View Details</a>
              </div>
            </div>
          ';
        }
      } else {
        echo '<p class="no-products">No products available at this moment.</p>';
      }
      ?>
    </div>
  </section>

</main>

<?php include('footer.php'); ?>

</body>
</html>
