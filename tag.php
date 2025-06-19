<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/header.php'; ?>
<main>
  <?php
  include 'db_connect.php';
  $tag = isset($_GET['tag']) ? trim($_GET['tag']) : '';
  ?>
  <section class="page-header">
    <h1>Тег: #<?= htmlspecialchars($tag) ?></h1>
    <p>Рестораны с тегом "<?= htmlspecialchars($tag) ?>"</p>
  </section>
  <section class="restaurants-list">
    <div class="restaurants-grid">
      <?php
      if ($tag) {
        $tag_esc = $conn->real_escape_string($tag);
        $sql = "SELECT * FROM restaurants WHERE tags LIKE '%$tag_esc%'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0):
          while($row = $result->fetch_assoc()):
      ?>
      <a href="restaurant.php?id=<?= $row['id'] ?>" class="restaurant-card" style="text-decoration:none;color:inherit;">
        <img src="<?= htmlspecialchars($row['img']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
        <div class="card-info">
          <div class="rating"><?= htmlspecialchars($row['rating']) ?></div>
          <div class="tags">
            <?php foreach(explode(',', $row['tags']) as $t): ?>
              <span><?= htmlspecialchars(trim($t)) ?></span>
            <?php endforeach; ?>
          </div>
          <div class="card-meta">
            <h3><?= htmlspecialchars($row['name']) ?></h3>
            <p><?= htmlspecialchars($row['type']) ?> · <?= htmlspecialchars($row['price']) ?> · <?= htmlspecialchars($row['metro']) ?></p>
            <p><?= htmlspecialchars($row['hours']) ?></p>
          </div>
        </div>
      </a>
      <?php endwhile; else: ?>
        <p>Нет ресторанов с этим тегом.</p>
      <?php endif; } else { ?>
        <p>Тег не указан.</p>
      <?php } ?>
    </div>
  </section>
</main>
<?php include 'includes/footer.php'; ?>
<style>
.tag-link span {
  background: #ffe5db;
  color: #ff3c1a;
  border-radius: 6px;
  padding: 2px 10px;
  font-size: 0.98rem;
  margin-right: 6px;
  text-decoration: none;
  transition: background 0.2s, color 0.2s;
}
.tag-link:hover span {
  background: #ff3c1a;
  color: #fff;
}
</style>
</body> 