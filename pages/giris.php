<?php
require_once __DIR__ . '/../auth.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (loginUser($email, $password, $errors)) {
        header('Location: index.php?sayfa=profil');
        exit;
    }
}
?>

<h2>Giriş Yap</h2>

<?php if ($errors): ?>
    <div style="color:#b00020; margin-bottom:10px;">
        <?php foreach ($errors as $e): ?>
            <p><?= htmlspecialchars($e) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post">
    <p>
        <label>E-posta<br>
            <input type="email" name="email" required>
        </label>
    </p>

    <p>
        <label>Şifre<br>
            <input type="password" name="password" required>
        </label>
    </p>

    <p>
        <button type="submit">Giriş Yap</button>
    </p>
</form>
