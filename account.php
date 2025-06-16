<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/header.php'; ?>

<main>
  <section class="profile-section">
    <div class="profile-header">
      <img src="assets/img/avatar.png" alt="Профиль" class="profile-avatar-large">
      <div class="profile-info">
        <div class="profile-name">Пупкин Василий</div>
        <div class="next-booking">
          <div><b>Ближайшая бронь:</b></div>
          <div>Время: <span class="booking-time">17:40</span></div>
          <div>Колл-во персон: <span class="booking-persons">2</span></div>
        </div>
        <div class="profile-actions">
          <button class="btn-cancel">Отмена</button>
          <button class="btn-move">Перенести</button>
        </div>
      </div>
      <div class="profile-booking-card">
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
    </div>
  </section>

  <section class="profile-bookings">
    <div class="section-title-row">
      <div class="section-title">Ваши брони</div>
      <a href="#" class="show-all-btn">Посмотреть все</a>
    </div>
    <div class="profile-cards-row">
      <?php for($i=0;$i<4;$i++): ?>
      <div class="restaurant-card">
        <img src="assets/img/bbqhouse.jpg" alt="BBQ House">
        <div class="card-info">
          <div class="rating">4.5</div>
          <div class="tags">
            <span>#American cuisine</span>
            <span>#Fastfood</span>
          </div>
          <h3>BBQ House</h3>
          <p>2 персоны · 16 декабря · <span class="booking-time">16:30</span></p>
          <p>Новогиреево, ТЦ Маяк, порошковый проезд 3</p>
        </div>
      </div>
      <?php endfor; ?>
    </div>
  </section>

  <section class="profile-favorites">
    <div class="section-title-row">
      <div class="section-title">Избранное</div>
      <a href="#" class="show-all-btn">Посмотреть все</a>
    </div>
    <div class="profile-cards-row">
      <?php for($i=0;$i<4;$i++): ?>
      <div class="restaurant-card">
        <img src="assets/img/bbqhouse.jpg" alt="BBQ House">
        <div class="card-info">
          <div class="rating">4.5</div>
          <div class="tags">
            <span>#American cuisine</span>
            <span>#Fastfood</span>
          </div>
          <h3>BBQ House</h3>
          <p>2 персоны · 16 декабря · <span class="booking-time">16:30</span></p>
          <p>Новогиреево, ТЦ Маяк, порошковый проезд 3</p>
        </div>
      </div>
      <?php endfor; ?>
    </div>
  </section>
</main>
<?php include 'includes/footer.php'; ?>
</body>
</html> 