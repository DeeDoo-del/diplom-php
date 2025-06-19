<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<header>
  <a class="logo-link" href="index.php"><div class="logo">Book <span class="logo-accent">aBite</span></div></a>
  <button class="burger-menu" id="burgerMenuBtn" aria-label="Открыть меню" style="display:none;">
    &#9776;
  </button>
  <form class="search-bar">
    <input type="text" placeholder="Type your request here...">
    <button type="submit">Search</button>
  </form>
  <nav id="mainNav">
    <a href="restaurants.php">About</a>
    <a href="#">Contact</a>
    <?php if(isset($_SESSION['user'])): ?>
      <?php $avatar = isset($_SESSION['user']['avatar']) && file_exists($_SESSION['user']['avatar']) ? $_SESSION['user']['avatar'] : 'assets/img/avatar.png'; ?>
      <a href="account.php" class="profile-avatar" title="Личный кабинет">
        <img src="<?= htmlspecialchars($avatar) ?>" alt="Профиль" style="width:32px;height:32px;border-radius:50%;vertical-align:middle;object-fit:cover;">
        <span style="margin-left:8px;vertical-align:middle;">Аккаунт</span>
      </a>
    <?php else: ?>
      <a href="login.php" class="account-btn">Login</a>
    <?php endif; ?>
  </nav>
</header>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var burger = document.getElementById('burgerMenuBtn');
  var nav = document.getElementById('mainNav');
  function checkWidth() {
    if(window.innerWidth <= 600) {
      burger.style.display = 'block';
      nav.classList.add('mobile-hidden');
    } else {
      burger.style.display = 'none';
      nav.classList.remove('mobile-hidden');
      nav.classList.remove('mobile-show');
    }
  }
  burger.addEventListener('click', function() {
    nav.classList.toggle('mobile-show');
    nav.classList.toggle('mobile-hidden');
  });
  window.addEventListener('resize', checkWidth);
  checkWidth();
});
</script> 