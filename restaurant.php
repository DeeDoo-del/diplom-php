<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/header.php'; ?>
<main>
  <?php
  // В будущем, когда будет подключена БД и передача id через URL:
  // $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
  // Здесь можно сделать запрос к БД для получения информации о ресторане по $id
  // $restaurant = getRestaurantById($id);
  // Если ресторан не найден, можно вывести 404 или заглушку
  // if (!$restaurant) { ... }
  // Сейчас используется статичная заглушка:
  $restaurant = [
    'name' => 'Егоркены обедки',
    'img' => 'assets/img/roof.jpg',
    'address' => 'Москва, Улица пушкина, дом калатушкина 32',
    'hours' => 'Открыто с 12 до 00:00',
    'tags' => ['#Суши', '#ПодОткрытымНебом', '#Дорого'],
    'description' => 'Описание ресторана. Здесь будет подробная информация о заведении, его особенностях, кухне, атмосфере и т.д.',
    'news' => [
      ['img' => 'assets/img/fire.jpg', 'text' => 'Теперь вы можете согреться у нас в камине'],
      ['img' => 'assets/img/bbqhouse.jpg', 'text' => 'Новая ригалка на страстном бульваре'],
      ['img' => 'assets/img/georgia.jpg', 'text' => 'Завалялась хач и пури. Доешьте кто нибудь'],
    ],
  ];
  ?>
  <section class="restaurant-hero">
    <img src="<?= $restaurant['img'] ?>" alt="<?= htmlspecialchars($restaurant['name']) ?>" class="restaurant-hero-img">
    <div class="restaurant-hero-title"><?= htmlspecialchars($restaurant['name']) ?></div>
    <div class="restaurant-hero-address">
      <?= htmlspecialchars($restaurant['address']) ?><br>
      <?= htmlspecialchars($restaurant['hours']) ?>
    </div>
  </section>
  <section class="restaurant-info">
    <div class="restaurant-tags">
      <?php foreach($restaurant['tags'] as $tag): ?>
        <span class="tag"><?= htmlspecialchars($tag) ?></span>
      <?php endforeach; ?>
    </div>
    <div class="restaurant-description">
      <?= htmlspecialchars($restaurant['description']) ?>
    </div>
    <div class="restaurant-actions">
      <button class="btn-menu">Меню</button>
      <a href="booking.php" class="btn-book">Забронировать</a>
    </div>
  </section>
  <section class="restaurant-news">
    <div class="section-title">Новости ресторана</div>
    <div class="restaurant-news-grid">
      <?php foreach($restaurant['news'] as $news): ?>
      <div class="news-item">
        <img src="<?= $news['img'] ?>" alt="">
        <span><?= htmlspecialchars($news['text']) ?></span>
      </div>
      <?php endforeach; ?>
    </div>
    <button class="btn-route">Построить маршрут</button>
  </section>
  <section class="restaurant-collections">
    <div class="section-title">Участвует в подборках</div>
    <div class="carousel-track">
      <?php for($i=0;$i<5;$i++): ?>
      <div class="restaurant-card">
        <img src="assets/img/bbqhouse.jpg" alt="BBQ House">
        <div class="card-info">
          <div class="rating">4.5</div>
          <div class="tags">
            <span>#American cuisine</span>
            <span>#Fastfood</span>
          </div>
          <h3>BBQ House</h3>
          <p>Бар · $$$$ · Новогиреево</p>
          <p>До 23:00</p>
        </div>
      </div>
      <?php endfor; ?>
    </div>
  </section>
  <section class="restaurant-similar">
    <div class="section-title">Похожие заведения</div>
    <div class="carousel-track">
      <?php for($i=0;$i<5;$i++): ?>
      <div class="restaurant-card">
        <img src="assets/img/bbqhouse.jpg" alt="BBQ House">
        <div class="card-info">
          <div class="rating">4.5</div>
          <div class="tags">
            <span>#American cuisine</span>
            <span>#Fastfood</span>
          </div>
          <h3>BBQ House</h3>
          <p>Бар · $$$$ · Новогиреево</p>
          <p>До 23:00</p>
        </div>
      </div>
      <?php endfor; ?>
    </div>
  </section>
</main>
<?php include 'includes/footer.php'; ?>
</body>
</html> 