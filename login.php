<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/header.php'; ?>
<main>
  <section class="auth-container">
    <div class="auth-tabs">
      <button class="auth-tab active" data-tab="login">Вход</button>
      <button class="auth-tab" data-tab="register">Регистрация</button>
    </div>

    <div class="auth-content">
      <!-- Форма входа -->
      <form class="auth-form active" id="loginForm">
        <div class="form-group">
          <label for="loginEmail">Email</label>
          <input type="email" id="loginEmail" name="email" required>
        </div>

        <div class="form-group">
          <label for="loginPassword">Пароль</label>
          <input type="password" id="loginPassword" name="password" required>
        </div>

        <div class="form-group">
          <label class="checkbox-label">
            <input type="checkbox" name="remember">
            <span class="checkmark"></span>
            Запомнить меня
          </label>
        </div>

        <button type="submit" class="btn-primary">Войти</button>
      </form>

      <!-- Форма регистрации -->
      <form class="auth-form" id="registerForm">
        <div class="form-group">
          <label for="registerName">Имя</label>
          <input type="text" id="registerName" name="name" required>
        </div>

        <div class="form-group">
          <label for="registerEmail">Email</label>
          <input type="email" id="registerEmail" name="email" required>
        </div>

        <div class="form-group">
          <label for="registerPhone">Телефон</label>
          <input type="tel" id="registerPhone" name="phone" required>
        </div>

        <div class="form-group">
          <label for="registerPassword">Пароль</label>
          <input type="password" id="registerPassword" name="password" required>
        </div>

        <div class="form-group">
          <label for="registerPasswordConfirm">Подтвердите пароль</label>
          <input type="password" id="registerPasswordConfirm" name="password_confirm" required>
        </div>

        <div class="form-group">
          <label class="checkbox-label">
            <input type="checkbox" name="agree" required>
            <span class="checkmark"></span>
            Я согласен с <a href="#" class="link">условиями использования</a>
          </label>
        </div>

        <button type="submit" class="btn-primary">Зарегистрироваться</button>
      </form>
    </div>
  </section>
</main>

<script>
// Переключение между вкладками
document.querySelectorAll('.auth-tab').forEach(function(tab) {
  tab.addEventListener('click', function() {
    const targetTab = this.dataset.tab;
    
    // Убираем активный класс у всех вкладок и форм
    document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.auth-form').forEach(f => f.classList.remove('active'));
    
    // Добавляем активный класс к выбранной вкладке и форме
    this.classList.add('active');
    document.getElementById(targetTab + 'Form').classList.add('active');
  });
});

// Обработка формы входа
document.getElementById('loginForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  if (validateLoginForm(this)) {
    showNotification('Вход выполнен успешно!', 'success');
    
    // Здесь будет отправка данных на сервер
    setTimeout(() => {
      window.location.href = 'account.php';
    }, 1500);
  }
});

// Обработка формы регистрации
document.getElementById('registerForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  if (validateRegisterForm(this)) {
    showNotification('Регистрация прошла успешно!', 'success');
    
    // Здесь будет отправка данных на сервер
    setTimeout(() => {
      window.location.href = 'account.php';
    }, 1500);
  }
});

function validateLoginForm(form) {
  const email = form.querySelector('#loginEmail');
  const password = form.querySelector('#loginPassword');
  let isValid = true;
  
  // Валидация email
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email.value)) {
    email.classList.add('error');
    isValid = false;
  } else {
    email.classList.remove('error');
  }
  
  // Валидация пароля
  if (password.value.length < 6) {
    password.classList.add('error');
    isValid = false;
  } else {
    password.classList.remove('error');
  }
  
  if (!isValid) {
    showNotification('Пожалуйста, проверьте правильность введенных данных', 'error');
  }
  
  return isValid;
}

function validateRegisterForm(form) {
  const name = form.querySelector('#registerName');
  const email = form.querySelector('#registerEmail');
  const phone = form.querySelector('#registerPhone');
  const password = form.querySelector('#registerPassword');
  const passwordConfirm = form.querySelector('#registerPasswordConfirm');
  const agree = form.querySelector('input[name="agree"]');
  let isValid = true;
  
  // Валидация имени
  if (name.value.length < 2) {
    name.classList.add('error');
    isValid = false;
  } else {
    name.classList.remove('error');
  }
  
  // Валидация email
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email.value)) {
    email.classList.add('error');
    isValid = false;
  } else {
    email.classList.remove('error');
  }
  
  // Валидация телефона
  const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
  if (!phoneRegex.test(phone.value.replace(/\s/g, ''))) {
    phone.classList.add('error');
    isValid = false;
  } else {
    phone.classList.remove('error');
  }
  
  // Валидация пароля
  if (password.value.length < 6) {
    password.classList.add('error');
    isValid = false;
  } else {
    password.classList.remove('error');
  }
  
  // Валидация подтверждения пароля
  if (password.value !== passwordConfirm.value) {
    passwordConfirm.classList.add('error');
    isValid = false;
  } else {
    passwordConfirm.classList.remove('error');
  }
  
  // Валидация согласия с условиями
  if (!agree.checked) {
    agree.classList.add('error');
    isValid = false;
  } else {
    agree.classList.remove('error');
  }
  
  if (!isValid) {
    showNotification('Пожалуйста, заполните все поля корректно', 'error');
  }
  
  return isValid;
}
</script>

<?php include 'includes/footer.php'; ?>
</body>
</html> 