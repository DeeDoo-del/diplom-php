<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/header.php'; ?>
<main>
  <section class="main-top-grid">
    <div class="main-banner">
      <img src="assets/img/Осень.jpg" alt="Осенняя осень">
      <span class="banner-title">Осенняя осень</span>
    </div>
    <div class="main-categories">
      <a href="collection.php?type=grill" class="category-item"><img src="assets/img/Бар.jpg" alt="На огне"><span>На огне</span></a>
      <a href="collection.php?type=bar" class="category-item"><img src="assets/img/Винишко.jpg" alt="Бары"><span>Бары</span></a>
      <a href="collection.php?type=pizza" class="category-item"><img src="assets/img/Груз.jpg" alt="Пицца"><span>Пицца</span></a>
      <a href="collection.php?type=molecular" class="category-item"><img src="assets/img/Зима.jpg" alt="Молекулярная кухня"><span>Молекулярная кухня</span></a>
      <a href="collection.php?type=georgian" class="category-item"><img src="assets/img/Молекулярная.jpg" alt="Грузия"><span>Грузия</span></a>
      <a href="collection.php?type=sushi" class="category-item"><img src="assets/img/Пицца.jpg" alt="Суши"><span>Суши</span></a>
    </div>
    <div class="main-promo">
      <img src="assets/img/Зима.jpg" alt="А зима то скоро">
      <span class="promo-title">А зима то скоро</span>
    </div>
  </section>
  <section class="filters">
    <form method="get" id="filtersForm">
      <label>Цена:
        <select name="price" class="filter-select">
          <option value="">Любая</option>
          <option value="$" <?= isset($_GET['price']) && $_GET['price'] == '$' ? 'selected' : '' ?>>$</option>
          <option value="$$" <?= isset($_GET['price']) && $_GET['price'] == '$$' ? 'selected' : '' ?>>$$</option>
          <option value="$$$" <?= isset($_GET['price']) && $_GET['price'] == '$$$' ? 'selected' : '' ?>>$$$</option>
          <option value="$$$$" <?= isset($_GET['price']) && $_GET['price'] == '$$$$' ? 'selected' : '' ?>>$$$$</option>
        </select>
      </label>
      <label>Кухня:
        <select name="type" class="filter-select">
          <option value="">Любая</option>
          <option value="asian" <?= isset($_GET['type']) && $_GET['type'] == 'asian' ? 'selected' : '' ?>>Азиатская</option>
          <option value="italian" <?= isset($_GET['type']) && $_GET['type'] == 'italian' ? 'selected' : '' ?>>Итальянская</option>
          <option value="american" <?= isset($_GET['type']) && $_GET['type'] == 'american' ? 'selected' : '' ?>>Американская</option>
          <option value="georgian" <?= isset($_GET['type']) && $_GET['type'] == 'georgian' ? 'selected' : '' ?>>Грузинская</option>
          <option value="japanese" <?= isset($_GET['type']) && $_GET['type'] == 'japanese' ? 'selected' : '' ?>>Японская</option>
        </select>
      </label>
      <label>Рейтинг:
        <select name="rating" class="filter-select">
          <option value="">Любой</option>
          <option value="5" <?= isset($_GET['rating']) && $_GET['rating'] == '5' ? 'selected' : '' ?>>5</option>
          <option value="4" <?= isset($_GET['rating']) && $_GET['rating'] == '4' ? 'selected' : '' ?>>4+</option>
          <option value="3" <?= isset($_GET['rating']) && $_GET['rating'] == '3' ? 'selected' : '' ?>>3+</option>
        </select>
      </label>
      <label>Метро:
        <select name="metro" class="filter-select">
          <option value="">Любое</option>
          <option value="Новогиреево" <?= isset($_GET['metro']) && $_GET['metro'] == 'Новогиреево' ? 'selected' : '' ?>>Новогиреево</option>
          <option value="Перово" <?= isset($_GET['metro']) && $_GET['metro'] == 'Перово' ? 'selected' : '' ?>>Перово</option>
          <option value="Шоссе Энтузиастов" <?= isset($_GET['metro']) && $_GET['metro'] == 'Шоссе Энтузиастов' ? 'selected' : '' ?>>Шоссе Энтузиастов</option>
        </select>
      </label>
    </form>
  </section>
  <section class="carousel-section">
    <div class="carousel-track">
      <?php
      include 'db_connect.php';
      $where = [];
      if (!empty($_GET['price'])) {
        $where[] = "price = '" . $conn->real_escape_string($_GET['price']) . "'";
      }
      if (!empty($_GET['type'])) {
        $type = $conn->real_escape_string($_GET['type']);
        $where[] = "tags LIKE '%$type%'";
      }
      if (!empty($_GET['rating'])) {
        if ($_GET['rating'] == '5') $where[] = "rating >= 5";
        elseif ($_GET['rating'] == '4') $where[] = "rating >= 4";
        elseif ($_GET['rating'] == '3') $where[] = "rating >= 3";
      }
      if (!empty($_GET['metro'])) {
        $where[] = "metro = '" . $conn->real_escape_string($_GET['metro']) . "'";
      }
      $sql = "SELECT * FROM restaurants";
      if ($where) {
        $sql .= " WHERE " . implode(' AND ', $where);
      }
      $sql .= " LIMIT 10";
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
    <a href="restaurants.php" class="show-all">Показать все</a>
  </section>

  <section class="carousel-section">
    <div class="carousel-title">Сезонные предложения</div>
    <div class="carousel-track">
      <?php
      $where = [];
      if (!empty($_GET['price'])) {
        $where[] = "price = '" . $conn->real_escape_string($_GET['price']) . "'";
      }
      if (!empty($_GET['type'])) {
        $type = $conn->real_escape_string($_GET['type']);
        $where[] = "tags LIKE '%$type%'";
      }
      if (!empty($_GET['rating'])) {
        if ($_GET['rating'] == '5') $where[] = "rating >= 5";
        elseif ($_GET['rating'] == '4') $where[] = "rating >= 4";
        elseif ($_GET['rating'] == '3') $where[] = "rating >= 3";
      }
      if (!empty($_GET['metro'])) {
        $where[] = "metro = '" . $conn->real_escape_string($_GET['metro']) . "'";
      }
      $sql = "SELECT * FROM restaurants";
      if ($where) {
        $sql .= " WHERE " . implode(' AND ', $where);
      }
      $sql .= " ORDER BY rating DESC LIMIT 10";
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

  <section class="weekend-picks">
    <div class="carousel-title">Подборки выходного дня</div>
    <div class="picks-grid">
      <a href="collection.php?type=bar" class="pick-item">
        <img src="assets/img/ТМбар.jpg" alt="Тематические бары">
        <span>Тематические бары</span>
      </a>
      <a href="collection.php?type=wine" class="pick-item">
        <img src="assets/img/Винишко.jpg" alt="Винишечко">
        <span>Винишечко</span>
      </a>
      <a href="collection.php?type=openair" class="pick-item">
        <img src="assets/img/Груз.jpg" alt="Под открытым небом">
        <span>Под открытым небом</span>
      </a>
      <a href="collection.php?type=pizza" class="pick-item">
        <img src="assets/img/Пицца.jpg" alt="Пицца">
        <span>Пицца</span>
      </a>
    </div>
  </section>

  <section class="carousel-section">
    <div class="carousel-title">Бесплатная доставка</div>
    <div class="carousel-track">
      <?php
      $sql = "SELECT * FROM restaurants WHERE price = '$$' OR price = '$' LIMIT 5";
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
</main>
<?php include 'includes/footer.php'; ?>
</body>
</html>

.category-item span, .pick-item span {
  color: #222 !important;
  text-decoration: none !important;
  font-weight: 500;
}
.category-item:visited span, .pick-item:visited span {
  color: #222 !important;
}
.category-item:hover span, .pick-item:hover span {
  color: #222 !important;
  text-decoration: none !important;
}