<?php
require_once __DIR__ . '/../auth.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? ''); 
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $password_again = trim($_POST['password_again'] ?? '');

    if (registerUser($name, $email, $password, $password_again, $errors)) {
        setFlashMessage('success', 'Kayıt başarılı! Şimdi giriş yapabilirsiniz.');
        header('Location: index.php?sayfa=giris');
        exit;
    }
}
?>

<h2>Kayıt Ol</h2>

<?php if ($errors): ?>
    <div class="error-message" style="margin-bottom:15px;">
        <?php foreach ($errors as $e): ?>
            <p><?= htmlspecialchars($e) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post">
    <p>
        <label>Ad Soyad<br>
            <input type="text" name="name" required value="<?= htmlspecialchars($name ?? '') ?>">
        </label>
    </p>

    <p>
        <label>E-posta<br>
            <input type="email" name="email" required value="<?= htmlspecialchars($email ?? '') ?>">
        </label>
    </p>

    <p>
        <label>Şifre<br>
            <input type="password" name="password" required>
        </label>
    </p>

    <p>
        <label>Şifre (Tekrar)<br>
            <input type="password" name="password_again" required>
        </label>
    </p>

    <p>
        <button type="submit">Kayıt Ol</button>
    </p>
</form>