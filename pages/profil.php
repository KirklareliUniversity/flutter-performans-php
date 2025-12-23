<?php
require_once __DIR__ . '/../auth.php'; // Yetkilendirme fonksiyonlarını dahil ettim.

$user = currentUser();
$message = ''; // Başarı mesajları için değişken
$errors = [];  // Hata mesajları için dizi

// Güvenlik Kontrolü: Kullanıcı giriş yapmamışsa, login sayfasına yönlendir.
if (!$user) {
    header('Location: index.php?sayfa=giris');
    exit;
}

// ŞİFRE GÜNCELLEME İŞLEMİ (POST kontrolü ve update_password form alanı kontrolü)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_password'])) {
    $current_password = trim($_POST['current_password'] ?? '');
    $new_password     = trim($_POST['new_password'] ?? '');
    $new_password_again = trim($_POST['new_password_again'] ?? '');

    // updatePassword fonksiyonu, hem hash kontrolü hem de UPDATE sorgusunu gerçekleştirir.
    if (updatePassword($user['id'], $current_password, $new_password, $new_password_again, $errors)) {
        // Başarı durumunda Flash Message kullanmak daha temizdir, ama şimdilik yerel değişken kullanıldı.
        $message = "Şifreniz başarıyla güncellendi.";
    }
}

// AD GÜNCELLEME İŞLEMİ (POST kontrolü ve update_name form alanı kontrolü)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_name'])) {
    $new_name = trim($_POST['new_name'] ?? '');

    // UPDATE sorgusunu çalıştır.
    if (updateUserName($user['id'], $new_name, $errors)) {
        $message = "Adınız başarıyla güncellendi.";
        $user = currentUser(); // Ad güncellendiği için kullanıcı verisini yeniledim.
    }
}
?>

<h2>Kullanıcı Profili</h2>

<?php if ($message): ?>
    <div class="success-message" style="margin-bottom: 20px;">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>

<?php if ($errors): ?>
    <div class="error-message" style="margin-bottom: 20px;">
        <?php foreach ($errors as $e): ?>
            <p><?= htmlspecialchars($e) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="info-card" style="margin-bottom: 30px;">
    <h3>Temel Bilgiler</h3>
    <p>Hoş geldin, <strong><?= htmlspecialchars($user['name']) ?></strong></p>
    <p>E-posta: <?= htmlspecialchars($user['email']) ?></p>
    <p>Kayıt tarihi: <?= htmlspecialchars($user['created_at']) ?></p>
    <p><a href="index.php?sayfa=cikis">Çıkış Yap</a></p>
</div>


<div class="info-grid">
    
    <div class="info-card profile-action-card">
        <h3>Adınızı Güncelleyin</h3>
        <form method="post" action="index.php?sayfa=profil">
            <input type="hidden" name="update_name" value="1"> <p>
                <label>Yeni Adınız<br>
                    <input type="text" name="new_name" value="<?= htmlspecialchars($user['name']) ?>" required>
                </label>
            </p>
            <p>
                <button type="submit">Adı Kaydet</button>
            </p>
        </form>
    </div>

    <div class="info-card profile-action-card">
        <h3>Şifrenizi Değiştirin</h3>
        <form method="post" action="index.php?sayfa=profil">
            <input type="hidden" name="update_password" value="1"> <p>
                <label>Mevcut Şifre<br>
                    <input type="password" name="current_password" required> </label>
            </p>
            <p>
                <label>Yeni Şifre<br>
                    <input type="password" name="new_password" required>
                </label>
            </p>
            <p>
                <label>Yeni Şifre (Tekrar)<br>
                    <input type="password" name="new_password_again" required> </label>
            </p>
            <p>
                <button type="submit">Şifreyi Güncelle</button>
            </p>
        </form>
    </div>

</div>