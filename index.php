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
      <div class="category-item"><img src="assets/img/Бар.jpg" alt="На огне"><span>На огне</span></div>
      <div class="category-item"><img src="assets/img/Винишко.jpg" alt="Бары"><span>Бары</span></div>
      <div class="category-item"><img src="assets/img/Груз.jpg" alt="Пицца"><span>Пицца</span></div>
      <div class="category-item"><img src="assets/img/Зима.jpg" alt="Молекулярная кухня"><span>Молекулярная кухня</span></div>
      <div class="category-item"><img src="assets/img/Молекулярная.jpg" alt="Грузия"><span>Грузия</span></div>
      <div class="category-item"><img src="assets/img/Пицца.jpg" alt="Суши"><span>Суши</span></div>
    </div>
    <div class="main-promo">
      <img src="assets/img/Зима.jpg" alt="А зима то скоро">
      <span class="promo-title">А зима то скоро</span>
    </div>
  </section>
  <section class="filters">
    <label>Цена:
      <select>
        <option value="">Любая</option>
        <option value="$">$</option>
        <option value="$$">$$</option>
        <option value="$$$">$$$</option>
        <option value="$$$$">$$$$</option>
      </select>
    </label>
    <label>Кухня:
      <select>
        <option value="">Любая</option>
        <option value="asian">Азиатская</option>
        <option value="italian">Итальянская</option>
        <option value="american">Американская</option>
        <option value="georgian">Грузинская</option>
        <option value="japanese">Японская</option>
      </select>
    </label>
    <label>Рейтинг:
      <select>
        <option value="">Любой</option>
        <option value="5">5</option>
        <option value="4">4+</option>
        <option value="3">3+</option>
      </select>
    </label>
  </section>
  <section class="carousel">
    <div class="carousel-track">
      <div class="restaurant-card">
        <img src="assets/img/Пон.jpg" alt="BBQ House">
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
      <!-- Дублируем карточки для примера -->
      <div class="restaurant-card">
        <img src="assets/img/Пон.jpg" alt="BBQ House">
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
      <div class="restaurant-card">
        <img src="assets/img/Пон.jpg" alt="BBQ House">
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
      <!-- ...ещё карточки... -->
    </div>
    <a href="restaurants.php" class="show-all">Показать все</a>
  </section>


  <section class="carousel-section">
    <div class="carousel-title">Сезонные предложения</div>
    <div class="carousel-track">
      <?php for($i=0;$i<5;$i++): ?>
      <div class="restaurant-card">
        <img src="assets/img/Пон.jpg" alt="BBQ House">
        <div class="card-info">
          <div class="rating">4.5</div>
          <div class="tags">
            <span>#Американская кухня</span>
            <span>#Фастфуд</span>
          </div>
          <h3>BBQ House</h3>
          <p>Бар · $$$$ · Новогиреево</p>
          <p>До 23:00</p>
        </div>
      </div>
      <?php endfor; ?>
    </div>
  </section>

  <section class="weekend-picks">
    <div class="carousel-title">Подборки выходного дня</div>
    <div class="picks-grid">
      <div class="pick-item">
        <img src="assets/img/ТМбар.jpg" alt="Тематические бары">
        <span>Тематические бары</span>
      </div>
      <div class="pick-item">
        <img src="assets/img/Бар.jpg" alt="Винишечко">
        <span>Винишечко</span>
      </div>
      <div class="pick-item">
        <img src="assets/img/Груз.jpg" alt="Под открытым небом">
        <span>Под открытым небом</span>
      </div>
    </div>
  </section>

  <section class="carousel-section">
    <div class="carousel-title">Бесплатная доставка</div>
    <div class="carousel-track">
      <?php for($i=0;$i<5;$i++): ?>
      <div class="restaurant-card">
        <img src="assets/img/Бар.jpg" alt="BBQ House">
        <div class="card-info">
          <div class="rating">4.5</div>
          <div class="tags">
            <span>#Американская кухня</span>
            <span>#Фастфуд</span>
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