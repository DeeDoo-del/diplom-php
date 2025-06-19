<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/header.php'; ?>
<main>
  <section class="page-header">
    <h1>Все рестораны</h1>
    <p>Найдите идеальное место для вашего ужина</p>
  </section>
  
  <section class="filters-section">
    <form class="filters-container" method="get" id="filtersForm">
      <div class="filter-group">
        <label>Цена:
          <select class="filter-select" name="price">
            <option value="">Любая</option>
            <option value="$" <?= isset($_GET['price']) && $_GET['price'] == '$' ? 'selected' : '' ?>>$</option>
            <option value="$$" <?= isset($_GET['price']) && $_GET['price'] == '$$' ? 'selected' : '' ?>>$$</option>
            <option value="$$$" <?= isset($_GET['price']) && $_GET['price'] == '$$$' ? 'selected' : '' ?>>$$$</option>
            <option value="$$$$" <?= isset($_GET['price']) && $_GET['price'] == '$$$$' ? 'selected' : '' ?>>$$$$</option>
          </select>
        </label>
      </div>
      <div class="filter-group">
        <label>Кухня:
          <select class="filter-select" name="type">
            <option value="">Любая</option>
            <option value="asian" <?= isset($_GET['type']) && $_GET['type'] == 'asian' ? 'selected' : '' ?>>Азиатская</option>
            <option value="italian" <?= isset($_GET['type']) && $_GET['type'] == 'italian' ? 'selected' : '' ?>>Итальянская</option>
            <option value="american" <?= isset($_GET['type']) && $_GET['type'] == 'american' ? 'selected' : '' ?>>Американская</option>
            <option value="georgian" <?= isset($_GET['type']) && $_GET['type'] == 'georgian' ? 'selected' : '' ?>>Грузинская</option>
            <option value="japanese" <?= isset($_GET['type']) && $_GET['type'] == 'japanese' ? 'selected' : '' ?>>Японская</option>
          </select>
        </label>
      </div>
      <div class="filter-group">
        <label>Рейтинг:
          <select class="filter-select" name="rating">
            <option value="">Любой</option>
            <option value="5" <?= isset($_GET['rating']) && $_GET['rating'] == '5' ? 'selected' : '' ?>>5</option>
            <option value="4" <?= isset($_GET['rating']) && $_GET['rating'] == '4' ? 'selected' : '' ?>>4+</option>
            <option value="3" <?= isset($_GET['rating']) && $_GET['rating'] == '3' ? 'selected' : '' ?>>3+</option>
          </select>
        </label>
      </div>
      <div class="filter-group">
        <label>Метро:
          <select class="filter-select" name="metro">
            <option value="">Любое</option>
            <option value="Новогиреево" <?= isset($_GET['metro']) && $_GET['metro'] == 'Новогиреево' ? 'selected' : '' ?>>Новогиреево</option>
            <option value="Перово" <?= isset($_GET['metro']) && $_GET['metro'] == 'Перово' ? 'selected' : '' ?>>Перово</option>
            <option value="Шоссе Энтузиастов" <?= isset($_GET['metro']) && $_GET['metro'] == 'Шоссе Энтузиастов' ? 'selected' : '' ?>>Шоссе Энтузиастов</option>
          </select>
        </label>
      </div>
    </form>
  </section>
  
  <section class="restaurants-list">
    <div class="restaurants-grid">
      <?php
      include 'db_connect.php';
      // Фильтрация
      $where = [];
      $params = [];
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
      if (!empty($_GET['search'])) {
        $search = mb_strtolower($conn->real_escape_string($_GET['search']));
        $where[] = "(LOWER(name) LIKE '%$search%' OR LOWER(tags) LIKE '%$search%')";
      }
      $sql = "SELECT * FROM restaurants";
      if ($where) {
        $sql .= " WHERE " . implode(' AND ', $where);
      }
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
      <?php endwhile; else: ?>
        <p>Нет ресторанов для отображения.</p>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php include 'includes/footer.php'; ?>
</body>
</html> 