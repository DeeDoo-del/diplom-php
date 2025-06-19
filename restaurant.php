<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/header.php'; ?>
<main>
  <?php
  include 'db_connect.php';
  $restaurant_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
  if ($restaurant_id > 0) {
    $sql = "SELECT * FROM restaurants WHERE id = $restaurant_id";
  } else {
    $sql = "SELECT * FROM restaurants LIMIT 1";
  }
  $result = $conn->query($sql);
  $restaurant = $result && $result->num_rows > 0 ? $result->fetch_assoc() : null;
  ?>
  <?php if($restaurant): ?>
  <section class="restaurant-hero">
    <img src="<?= htmlspecialchars($restaurant['img']) ?>" alt="<?= htmlspecialchars($restaurant['name']) ?>" class="restaurant-hero-img">
    <div class="restaurant-hero-title"><?= htmlspecialchars($restaurant['name']) ?></div>
    <div class="restaurant-hero-address">
      <?= htmlspecialchars($restaurant['address']) ?><br>
      <?= htmlspecialchars($restaurant['hours']) ?>
    </div>
  </section>
  <section class="restaurant-info">
    <div class="restaurant-tags">
      <?php foreach(explode(',', $restaurant['tags']) as $tag): ?>
        <span class="tag"><?= htmlspecialchars(trim($tag)) ?></span>
      <?php endforeach; ?>
    </div>
    <div class="restaurant-description">
      <?= htmlspecialchars($restaurant['description']) ?>
    </div>
    <div class="restaurant-actions">
      <button class="btn-menu">Меню</button>
      <a href="booking.php?id=<?= $restaurant['id'] ?>" class="btn-book">Забронировать</a>
    </div>
  </section>
  <section class="restaurant-collections">
    <div class="section-title">Участвует в подборках</div>
    <div class="carousel-track">
      <?php
      $sql = "SELECT * FROM restaurants WHERE id != {$restaurant['id']} LIMIT 5";
      $result = $conn->query($sql);
      if ($result && $result->num_rows > 0):
        while($row = $result->fetch_assoc()):
      ?>
      <a href="restaurant.php?id=<?= $row['id'] ?>" class="restaurant-card" style="text-decoration:none;color:inherit;">
        <img src="<?= htmlspecialchars($row['img']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
        <div class="card-info">
          <div class="rating"><?= htmlspecialchars($row['rating']) ?></div>
          <div class="tags">
            <?php foreach(explode(',', $row['tags']) as $tag): ?>
              <span><?= htmlspecialchars($tag) ?></span>
            <?php endforeach; ?>
          </div>
          <div class="card-meta">
            <h3><?= htmlspecialchars($row['name']) ?></h3>
            <p><?= htmlspecialchars($row['type']) ?> · <?= htmlspecialchars($row['price']) ?> · <?= htmlspecialchars($row['metro']) ?></p>
            <p><?= htmlspecialchars($row['hours']) ?></p>
          </div>
        </div>
      </a>
      <?php endwhile; endif; ?>
    </div>
  </section>
  <section class="restaurant-similar">
    <div class="section-title">Похожие заведения</div>
    <div class="carousel-track">
      <?php
      $sql = "SELECT * FROM restaurants WHERE id != {$restaurant['id']} ORDER BY rating DESC LIMIT 5";
      $result = $conn->query($sql);
      if ($result && $result->num_rows > 0):
        while($row = $result->fetch_assoc()):
      ?>
      <a href="restaurant.php?id=<?= $row['id'] ?>" class="restaurant-card" style="text-decoration:none;color:inherit;">
        <img src="<?= htmlspecialchars($row['img']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
        <div class="card-info">
          <div class="rating"><?= htmlspecialchars($row['rating']) ?></div>
          <div class="tags">
            <?php foreach(explode(',', $row['tags']) as $tag): ?>
              <span><?= htmlspecialchars($tag) ?></span>
            <?php endforeach; ?>
          </div>
          <div class="card-meta">
            <h3><?= htmlspecialchars($row['name']) ?></h3>
            <p><?= htmlspecialchars($row['type']) ?> · <?= htmlspecialchars($row['price']) ?> · <?= htmlspecialchars($row['metro']) ?></p>
            <p><?= htmlspecialchars($row['hours']) ?></p>
          </div>
        </div>
      </a>
      <?php endwhile; endif; ?>
    </div>
  </section>
  <?php else: ?>
    <section><p>Ресторан не найден.</p></section>
  <?php endif; ?>
</main>
<?php include 'includes/footer.php'; ?>
</body>
</html> 