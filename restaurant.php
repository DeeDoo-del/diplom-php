<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/header.php'; ?>
<main>
  <section class="restaurant-hero">
    <img src="assets/img/roof.jpg" alt="Егоркены обедки" class="restaurant-hero-img">
    <div class="restaurant-hero-title">Егоркены обедки</div>
    <div class="restaurant-hero-address">
      Москва, Улица пушкина, дом калатушкина 32<br>
      Открыто с 12 до 00:00
    </div>
  </section>
  <section class="restaurant-info">
    <div class="restaurant-tags">
      <span class="tag">#Суши</span>
      <span class="tag">#ПодОткрытымНебом</span>
      <span class="tag">#Дорого</span>
    </div>
    <div class="restaurant-description">
      ОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписаниеОписание
    </div>
    <div class="restaurant-actions">
      <button class="btn-menu">Меню</button>
      <a href="booking.php" class="btn-book">Забронировать</a>
    </div>
  </section>
  <section class="restaurant-news">
    <div class="section-title">Новости ресторана</div>
    <div class="restaurant-news-grid">
      <div class="news-item">
        <img src="assets/img/fire.jpg" alt="">
        <span>Теперь вы можете согреться у нас в камине</span>
      </div>
      <div class="news-item">
        <img src="assets/img/bbqhouse.jpg" alt="">
        <span>Новая ригалка на страстном бульваре</span>
      </div>
      <div class="news-item">
        <img src="assets/img/georgia.jpg" alt="">
        <span>Завалялась хач и пури. Доешьте кто нибудь</span>
      </div>
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