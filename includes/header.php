<header>
  <div class="logo">Book <span class="logo-accent">aBite</span></div>
  <form class="search-bar">
    <input type="text" placeholder="Type your request here...">
    <button type="submit">Search</button>
  </form>
  <nav>
    <a href="restaurants.php">About</a>
    <a href="#">Contact</a>
    <?php if(isset($_SESSION['user'])): ?>
      <a href="account.php" class="profile-avatar">
        <img src="assets/img/avatar.png" alt="Профиль" />
      </a>
    <?php else: ?>
      <a href="login.php" class="account-btn">Login</a>
    <?php endif; ?>
  </nav>
</header> 