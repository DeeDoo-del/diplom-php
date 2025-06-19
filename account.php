<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user']['id'];
$profile_error = '';
$profile_success = '';

// Обработка обновления профиля
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $avatar_path = null;
    // Обработка загрузки аватара
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif','webp'];
        if (in_array($ext, $allowed)) {
            $new_name = 'avatar_' . $user_id . '_' . time() . '.' . $ext;
            $upload_dir = 'assets/img/avatars/';
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
            $avatar_path = $upload_dir . $new_name;
            move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar_path);
        } else {
            $profile_error = 'Разрешены только изображения jpg, png, gif, webp.';
        }
    }
    if ($name === '' || $email === '' || $phone === '') {
        $profile_error = 'Пожалуйста, заполните все поля.';
    } elseif (!$profile_error) {
        if ($avatar_path) {
            $stmt = $conn->prepare("UPDATE users SET name=?, email=?, phone=?, avatar=? WHERE id=?");
            $stmt->bind_param("ssssi", $name, $email, $phone, $avatar_path, $user_id);
        } else {
            $stmt = $conn->prepare("UPDATE users SET name=?, email=?, phone=? WHERE id=?");
            $stmt->bind_param("sssi", $name, $email, $phone, $user_id);
        }
        if ($stmt->execute()) {
            $profile_success = 'Данные успешно обновлены!';
            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['phone'] = $phone;
            if ($avatar_path) $_SESSION['user']['avatar'] = $avatar_path;
        } else {
            $profile_error = 'Ошибка при обновлении данных.';
        }
        $stmt->close();
    }
}
// Получаем актуальные данные пользователя
$stmt = $conn->prepare("SELECT name, email, phone, avatar FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $email, $phone, $avatar);
$stmt->fetch();
$stmt->close();
$avatar_url = $avatar && file_exists($avatar) ? $avatar : 'assets/img/avatar.png';
?>
<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/header.php'; ?>

<main>
  <section class="profile-section" style="display:flex;gap:32px;align-items:flex-start;flex-wrap:wrap;flex-direction:row;">
    <div style="max-width:340px;width:100%;margin:0;flex:1 1 340px;">
      <form method="post" class="profile-form" enctype="multipart/form-data">
        <h2 style="margin-bottom:16px;">Профиль</h2>
        <?php if($profile_error): ?>
          <div class="notification notification-error" style="margin-bottom:10px;"> <?= htmlspecialchars($profile_error) ?> </div>
        <?php endif; ?>
        <?php if($profile_success): ?>
          <div class="notification notification-success" style="margin-bottom:10px;"> <?= htmlspecialchars($profile_success) ?> </div>
        <?php endif; ?>
        <div style="text-align:center;margin-bottom:16px;">
          <img src="<?= htmlspecialchars($avatar_url) ?>" alt="Профиль" class="profile-avatar-large" style="margin-bottom:8px;">
          <div>
            <input type="file" name="avatar" accept="image/*" id="avatarInput" style="display:none;">
            <label for="avatarInput" class="btn-secondary" style="cursor:pointer;">Сменить фото</label>
          </div>
        </div>
        <div class="form-group">
          <label for="profileName">Имя</label>
          <input type="text" id="profileName" name="name" value="<?= htmlspecialchars($name) ?>" required>
        </div>
        <div class="form-group">
          <label for="profileEmail">Email</label>
          <input type="email" id="profileEmail" name="email" value="<?= htmlspecialchars($email) ?>" required>
        </div>
        <div class="form-group">
          <label for="profilePhone">Телефон</label>
          <input type="tel" id="profilePhone" name="phone" value="<?= htmlspecialchars($phone) ?>" required>
        </div>
        <div class="form-actions">
          <button type="submit" name="update_profile" class="btn-primary">Сохранить</button>
        </div>
      </form>
    </div>
    <div class="profile-booking-card" style="flex:0 0 370px;max-width:370px;width:100%;margin:0;">
      <?php
      $sql = "SELECT * FROM restaurants LIMIT 1";
      $result = $conn->query($sql);
      if ($result && $result->num_rows > 0):
        while($row = $result->fetch_assoc()):
      ?>
      <div class="restaurant-card">
        <img src="<?= htmlspecialchars($row['img']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
        <div class="card-info">
          <div class="rating"><?= htmlspecialchars($row['rating']) ?></div>
          <div class="tags">
            <?php foreach(explode(',', $row['tags']) as $tag): ?>
              <span><?= htmlspecialchars(trim($tag)) ?></span>
            <?php endforeach; ?>
          </div>
          <div class="card-meta">
            <h3><?= htmlspecialchars($row['name']) ?></h3>
            <p><?= htmlspecialchars($row['type']) ?> · <?= htmlspecialchars($row['price']) ?> · <?= htmlspecialchars($row['metro']) ?></p>
            <p><?= htmlspecialchars($row['hours']) ?></p>
          </div>
        </div>
      </div>
      <?php endwhile; endif; ?>
    </div>
  </section>

  <section class="profile-favorites">
    <div class="section-title-row">
      <div class="section-title">Избранное</div>
      <a href="#" class="show-all-btn">Посмотреть все</a>
    </div>
    <div class="profile-cards-row">
      <?php
      $sql = "SELECT * FROM restaurants LIMIT 4 OFFSET 1";
      $result = $conn->query($sql);
      if ($result && $result->num_rows > 0):
        while($row = $result->fetch_assoc()):
      ?>
      <a href="restaurant.php?id=<?= $row['id'] ?>" class="restaurant-card" style="text-decoration:none;color:inherit;">
        <img src="<?= htmlspecialchars($row['img']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
        <div class="card-info">
          <div class="rating"><?= htmlspecialchars($row['rating']) ?></div>
          <div class="tags">
            <?php foreach(explode(',', $row['tags']) as $tag): ?>
              <span><?= htmlspecialchars(trim($tag)) ?></span>
            <?php endforeach; ?>
          </div>
          <div class="card-meta">
            <h3><?= htmlspecialchars($row['name']) ?></h3>
            <p><?= htmlspecialchars($row['type']) ?> · <?= htmlspecialchars($row['price']) ?> · <?= htmlspecialchars($row['metro']) ?></p>
            <p><?= htmlspecialchars($row['hours']) ?></p>
          </div>
        </div>
      </a>
      <?php endwhile; endif; ?>
    </div>
  </section>
</main>
<?php include 'includes/footer.php'; ?>
<style>
.profile-section {
  display: flex;
  flex-direction: row;
  gap: 32px;
  align-items: flex-start;
  flex-wrap: wrap;
}
@media (max-width: 900px) {
  .profile-section {
    flex-direction: column;
    gap: 18px;
  }
}
.booking-wide-center {
  max-width: 920px;
  width: 100%;
  margin: 32px auto 0 auto;
  display: flex;
  justify-content: center;
}
@media (max-width: 900px) {
  .booking-wide-center {
    width: 95%;
    max-width: 100%;
    margin: 24px auto 0 auto;
  }
}
@media (max-width: 600px) {
  .booking-wide-center {
    width: 100%;
    max-width: 100%;
    margin: 16px 0 0 0;
    padding: 0;
  }
}
</style>
</body>
</html> 