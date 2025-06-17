<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/header.php'; ?>
<main>
  <section class="booking-header">
    <h1>Бронирование столика</h1>
    <p>Забронируйте столик в ресторане "Егоркены обедки"</p>
  </section>

  <section class="booking-form-section">
    <div class="booking-form-container">
      <form class="booking-form" id="bookingForm">
        <div class="form-group">
          <label for="name">Ваше имя *</label>
          <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
          <label for="phone">Номер телефона *</label>
          <input type="tel" id="phone" name="phone" required>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email">
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="date">Дата *</label>
            <input type="date" id="date" name="date" required>
          </div>

          <div class="form-group">
            <label for="time">Время *</label>
            <select id="time" name="time" required>
              <option value="">Выберите время</option>
              <option value="12:00">12:00</option>
              <option value="12:30">12:30</option>
              <option value="13:00">13:00</option>
              <option value="13:30">13:30</option>
              <option value="14:00">14:00</option>
              <option value="14:30">14:30</option>
              <option value="15:00">15:00</option>
              <option value="15:30">15:30</option>
              <option value="16:00">16:00</option>
              <option value="16:30">16:30</option>
              <option value="17:00">17:00</option>
              <option value="17:30">17:30</option>
              <option value="18:00">18:00</option>
              <option value="18:30">18:30</option>
              <option value="19:00">19:00</option>
              <option value="19:30">19:30</option>
              <option value="20:00">20:00</option>
              <option value="20:30">20:30</option>
              <option value="21:00">21:00</option>
              <option value="21:30">21:30</option>
              <option value="22:00">22:00</option>
              <option value="22:30">22:30</option>
              <option value="23:00">23:00</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="guests">Количество гостей *</label>
          <select id="guests" name="guests" required>
            <option value="">Выберите количество</option>
            <option value="1">1 человек</option>
            <option value="2">2 человека</option>
            <option value="3">3 человека</option>
            <option value="4">4 человека</option>
            <option value="5">5 человек</option>
            <option value="6">6 человек</option>
            <option value="7">7 человек</option>
            <option value="8">8 человек</option>
            <option value="9">9 человек</option>
            <option value="10">10 человек</option>
            <option value="more">Больше 10</option>
          </select>
        </div>

        <div class="form-group">
          <label for="special">Особые пожелания</label>
          <textarea id="special" name="special" rows="4" placeholder="Например: столик у окна, детский стул, особые диетические требования..."></textarea>
        </div>

        <div class="form-actions">
          <button type="button" class="btn-secondary" onclick="history.back()">Отмена</button>
          <button type="submit" class="btn-primary">Забронировать</button>
        </div>
      </form>

      <div class="booking-info">
        <div class="restaurant-card">
          <img src="assets/img/roof.jpg" alt="Егоркены обедки">
          <div class="card-info">
            <div class="rating">4.5</div>
            <div class="tags">
              <span>#Суши</span>
              <span>#ПодОткрытымНебом</span>
            </div>
            <h3>Егоркены обедки</h3>
            <p>Москва, Улица пушкина, дом калатушкина 32</p>
            <p>Открыто с 12 до 00:00</p>
          </div>
        </div>

        <div class="booking-rules">
          <h4>Правила бронирования</h4>
          <ul>
            <li>Бронирование действительно в течение 15 минут</li>
            <li>При отмене брони просим уведомить за 2 часа</li>
            <li>Максимальное время ожидания - 15 минут</li>
            <li>Дети до 3 лет - бесплатно</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</main>

<script>
document.getElementById('bookingForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  if (validateBookingForm(this)) {
    // Здесь будет отправка данных на сервер
    showNotification('Бронирование успешно создано!', 'success');
    
    // Очищаем форму
    this.reset();
    
    // Перенаправляем на страницу подтверждения
    setTimeout(() => {
      window.location.href = 'account.php';
    }, 2000);
  }
});

function validateBookingForm(form) {
  const requiredFields = form.querySelectorAll('[required]');
  let isValid = true;
  
  requiredFields.forEach(function(field) {
    if (!field.value.trim()) {
      field.classList.add('error');
      isValid = false;
    } else {
      field.classList.remove('error');
    }
  });
  
  // Валидация телефона
  const phone = form.querySelector('#phone');
  const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
  if (phone.value && !phoneRegex.test(phone.value.replace(/\s/g, ''))) {
    phone.classList.add('error');
    isValid = false;
  }
  
  // Валидация email
  const email = form.querySelector('#email');
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (email.value && !emailRegex.test(email.value)) {
    email.classList.add('error');
    isValid = false;
  }
  
  if (!isValid) {
    showNotification('Пожалуйста, заполните все обязательные поля корректно', 'error');
  }
  
  return isValid;
}
</script>

<?php include 'includes/footer.php'; ?>
</body>
</html> 