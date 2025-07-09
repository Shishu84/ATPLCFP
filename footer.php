<?php
include('config.php');
$current_year = date('Y');

// Fetch footer content
$footer = ['about' => '', 'quick_links' => [], 'contact' => [], 'social' => []];
$query = "SELECT * FROM footer_content WHERE is_active = 1";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
  switch ($row['section']) {
    case 'about':
      $footer['about'] = $row['content'];
      break;
    case 'quick_links':
      $footer['quick_links'][] = ['label' => $row['content'], 'link' => $row['link']];
      break;
    case 'contact':
      $footer['contact'][] = $row['content'];
      break;
    case 'social':
      $footer['social'][] = ['icon' => $row['icon'], 'link' => $row['link']];
      break;
  }
}
?>

<style>
.footer {
  background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
  color: white;
  padding: 40px 20px 20px;
  font-family: 'Segoe UI', sans-serif;
}
.footer a { color: #ffcc00; text-decoration: none; }
.footer a:hover { color: #fff; text-decoration: underline; }
.footer-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 30px;
}
.footer-column h4 {
  margin-bottom: 15px;
  color: #ffcc00;
}
.footer-column ul, .footer-column p, .footer-column address {
  margin: 0; padding: 0; list-style: none;
}
.footer-column li { margin-bottom: 8px; }
.footer-column .social-icons a {
  display: inline-block;
  margin-right: 10px;
}
.footer-column .social-icons img {
  width: 26px;
  transition: transform 0.3s;
}
.footer-column .social-icons img:hover {
  transform: scale(1.2);
}
.footer-bottom {
  text-align: center;
  margin-top: 30px;
  border-top: 1px solid #444;
  padding-top: 15px;
  font-size: 14px;
  color: #bbb;
}

/* Dark Mode Toggle */
.dark-toggle {
  position: fixed;
  bottom: 25px;
  left: 25px;
  background: #222;
  color: white;
  border: none;
  padding: 10px 16px;
  border-radius: 20px;
  cursor: pointer;
  box-shadow: 0 2px 10px rgba(0,0,0,0.3);
}
.dark-mode {
  background: #111 !important;
  color: #ddd !important;
}
.dark-mode .footer a { color: #00ffff; }
.dark-mode .footer-column h4 { color: #00ffff; }
</style>

<footer class="footer" id="footer">
  <div class="footer-container">
    <div class="footer-column">
      <h4>About Us</h4>
      <p><?= $footer['about']; ?></p>
    </div>

    <div class="footer-column">
      <h4>Quick Links</h4>
      <ul>
        <?php foreach ($footer['quick_links'] as $link): ?>
          <li><a href="<?= $link['link']; ?>"><?= $link['label']; ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="footer-column">
      <h4>Contact</h4>
      <address>
        <?php foreach ($footer['contact'] as $c): echo $c . '<br>'; endforeach; ?>
      </address>
    </div>

    <div class="footer-column">
      <h4>Follow Us</h4>
      <div class="social-icons">
        <?php foreach ($footer['social'] as $s): ?>
          <a href="<?= $s['link']; ?>" target="_blank">
            <img src="<?= $s['icon']; ?>" alt="social">
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; <?= $current_year; ?> MyShop. All rights reserved.</p>
  </div>
</footer>

<!-- Dark Mode Toggle -->
<button class="dark-toggle" onclick="toggleDark()">🌙 Toggle Dark</button>

<script>
function toggleDark() {
  document.body.classList.toggle('dark-mode');
  document.getElementById('footer').classList.toggle('dark-mode');
}
</script>
