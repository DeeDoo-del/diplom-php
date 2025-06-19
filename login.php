<?php
session_start();
require_once 'db_connect.php';

$register_error = '';
$login_error = '';

// Регистрация
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password !== $password_confirm) {
        $register_error = "Пароли не совпадают!";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $register_error = "Пользователь с таким email уже существует!";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $role = 'client';
            $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password_hash, role) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $name, $email, $phone, $password_hash, $role);
            if ($stmt->execute()) {
                $_SESSION['user'] = [
                    'id' => $stmt->insert_id,
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'role' => $role
                ];
                header("Location: account.php");
                exit;
            } else {
                $register_error = "Ошибка регистрации. Попробуйте позже.";
            }
        }
        $stmt->close();
    }
}

// Вход
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, name, email, password_hash, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $name, $email_db, $password_hash, $role);
    if ($stmt->fetch() && password_verify($password, $password_hash)) {
        $_SESSION['user'] = [
            'id' => $id,
            'name' => $name,
            'email' => $email_db,
            'role' => $role
        ];
        header("Location: account.php");
        exit;
    } else {
        $login_error = "Неверный email или пароль!";
    }
    $stmt->close();
}
?>
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
      <?php if($login_error): ?>
        <div class="notification notification-error" style="margin-bottom:16px;"> <?= htmlspecialchars($login_error) ?> </div>
      <?php endif; ?>
      <form class="auth-form active" id="loginForm" method="post">
        <input type="hidden" name="login" value="1">
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
      <?php if($register_error): ?>
        <div class="notification notification-error" style="margin-bottom:16px;"> <?= htmlspecialchars($register_error) ?> </div>
      <?php endif; ?>
      <form class="auth-form" id="registerForm" method="post">
        <input type="hidden" name="register" value="1">
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
// document.getElementById('loginForm').addEventListener('submit', function(e) {
//   e.preventDefault();
//   if (validateLoginForm(this)) {
//     showNotification('Вход выполнен успешно!', 'success');
//     setTimeout(() => {
//       window.location.href = 'account.php';
//     }, 1500);
//   }
// });

// Обработка формы регистрации
// document.getElementById('registerForm').addEventListener('submit', function(e) {
//   e.preventDefault();
//   if (validateRegisterForm(this)) {
//     showNotification('Регистрация прошла успешно!', 'success');
//     setTimeout(() => {
//       window.location.href = 'account.php';
//     }, 1500);
//   }
// });

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