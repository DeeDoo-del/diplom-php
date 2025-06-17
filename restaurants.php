<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/header.php'; ?>
<main>
  <section class="page-header">
    <h1>Все рестораны</h1>
    <p>Найдите идеальное место для вашего ужина</p>
  </section>
  
  <section class="filters-section">
    <div class="filters-container">
      <div class="filter-group">
        <label>Цена:</label>
        <select class="filter-select">
          <option value="">Любая</option>
          <option value="$">$</option>
          <option value="$$">$$</option>
          <option value="$$$">$$$</option>
          <option value="$$$$">$$$$</option>
        </select>
      </div>
      <div class="filter-group">
        <label>Кухня:</label>
        <select class="filter-select">
          <option value="">Любая</option>
          <option value="asian">Азиатская</option>
          <option value="italian">Итальянская</option>
          <option value="american">Американская</option>
          <option value="georgian">Грузинская</option>
          <option value="japanese">Японская</option>
        </select>
      </div>
      <div class="filter-group">
        <label>Рейтинг:</label>
        <select class="filter-select">
          <option value="">Любой</option>
          <option value="5">5</option>
          <option value="4">4+</option>
          <option value="3">3+</option>
        </select>
      </div>
      <div class="filter-group">
        <label>Метро:</label>
        <select class="filter-select">
          <option value="">Любое</option>
          <option value="novogireevo">Новогиреево</option>
          <option value="perovo">Перово</option>
          <option value="shosse">Шоссе Энтузиастов</option>
        </select>
      </div>
    </div>
  </section>
  
  <section class="restaurants-list">
    <div class="restaurants-grid">
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
      <!-- Дублируем карточки для примера -->
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
    </div>
  </section>
</main>
<?php include 'includes/footer.php'; ?>
</body>
</html> 