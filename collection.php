<?php
include 'includes/head.php';
include 'includes/header.php';

// Массив подборок
$collections = [
  'bar' => [
    'title' => 'Тематические бары',
    'desc' => 'Лучшие бары города для особых вечеров.',
    'img' => 'assets/img/ТМбар.jpg',
    'filter' => ['tags' => 'бар']
  ],
  'pizza' => [
    'title' => 'Пицца',
    'desc' => 'Где попробовать лучшую пиццу.',
    'img' => 'assets/img/pizza.jpg',
    'filter' => ['tags' => 'пицца']
  ],
  'wine' => [
    'title' => 'Винный базар',
    'desc' => 'Места для ценителей вина и уютных вечеров.',
    'img' => 'assets/img/vinishko.jpg',
    'filter' => ['tags' => 'вино']
  ],
  'openair' => [
    'title' => 'Под открытым небом',
    'desc' => 'Лучшие заведения с верандами и летними площадками.',
    'img' => 'assets/img/otkrytoeNebo1.jpg',
    'filter' => ['tags' => 'openair']
  ],
  'grill' => [
    'title' => 'На огне',
    'desc' => 'Лучшие блюда, приготовленные на гриле и открытом огне.',
    'img' => 'assets/img/Бар.jpg',
    'filter' => ['tags' => 'гриль']
  ],
  'molecular' => [
    'title' => 'Молекулярная кухня',
    'desc' => 'Современные эксперименты и необычные вкусы.',
    'img' => 'assets/img/Молекулярная.jpg',
    'filter' => ['tags' => 'молекулярная']
  ],
  'georgian' => [
    'title' => 'Грузия',
    'desc' => 'Грузинская кухня и атмосфера настоящего Тбилиси.',
    'img' => 'assets/img/gruz.jpg',
    'filter' => ['tags' => 'грузинская']
  ],
  'sushi' => [
    'title' => 'Суши',
    'desc' => 'Лучшие суши-бары и японские рестораны.',
    'img' => 'assets/img/izumi.jpg',
    'filter' => ['tags' => 'суши']
  ],
  'summer' => [
    'title' => 'Летняя подборка',
    'desc' => 'Лучшие летние рестораны и веранды города.',
    'img' => 'assets/img/letneeLeto.jpg',
    'filter' => ['tags' => 'openair']
  ],
];

$type = isset($_GET['type']) ? $_GET['type'] : '';
$collection = isset($collections[$type]) ? $collections[$type] : null;
?>
<main>
<?php if($collection): ?>
  <section class="collection-hero" style="display:flex;align-items:center;gap:32px;margin-bottom:32px;">
    <img src="<?= htmlspecialchars($collection['img']) ?>" alt="<?= htmlspecialchars($collection['title']) ?>" style="width:220px;height:160px;object-fit:cover;border-radius:18px;">
    <div>
      <h1 style="margin-bottom:12px;"><?= htmlspecialchars($collection['title']) ?></h1>
      <p style="font-size:1.15rem;"><?= htmlspecialchars($collection['desc']) ?></p>
    </div>
  </section>
  <section class="restaurants-list">
    <div class="restaurants-grid">
      <?php
      include 'db_connect.php';
      $where = [];
      if (!empty($collection['filter']['tags'])) {
        $tag = $conn->real_escape_string($collection['filter']['tags']);
        $where[] = "tags LIKE '%$tag%'";
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
              <span><?= htmlspecialchars(trim($tag)) ?></span>
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
        <p>Нет ресторанов для этой подборки.</p>
      <?php endif; ?>
    </div>
  </section>
<?php else: ?>
  <section><h1>Подборка не найдена</h1></section>
<?php endif; ?>
</main>
<?php include 'includes/footer.php'; ?> 