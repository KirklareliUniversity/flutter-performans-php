<?php
// auth.php – MySQL tabanlı giriş/kayıt/çıkış/güncelleme sistemi
require_once __DIR__ . '/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Şu an giriş yapmış kullanıcıyı döndürür
 */
function currentUser()
{
    if (!isset($_SESSION['user_id'])) {
        return null;
    }

    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT id, name, email, created_at FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    return $user ?: null;
}

/**
 * Yeni kullanıcı kaydı
 */
function registerUser(string $name, string $email, string $password, string $password_again, array &$errors): bool
{
    $pdo = getPDO();
    $errors = [];

    if (trim($name) === '' || trim($email) === '' || trim($password) === '') {
        $errors[] = "Tüm alanları doldurmanız gerekiyor.";
        return false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Geçerli bir e-posta adresi girin.";
        return false;
    }

    if ($password !== $password_again) {
        $errors[] = "Şifreler birbiriyle uyuşmuyor.";
        return false;
    }
    
    if (strlen($password) < 6) {
        $errors[] = "Şifre en az 6 karakter olmalıdır.";
        return false;
    }

    // E-posta zaten var mı?
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        $errors[] = "Bu e-posta ile zaten bir hesap var.";
        return false;
    }

    // Parola hash (BCRYPT kullanılıyor)
    $hash = password_hash($password, PASSWORD_BCRYPT);

    // Yeni kullanıcı ekle
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)");
    $result = $stmt->execute([$name, $email, $hash]);

    if ($result) {
        setFlashMessage('success', 'Kaydınız başarıyla tamamlandı. Şimdi giriş yapabilirsiniz.');
        return true;
    }
    
    $errors[] = "Kayıt sırasında veritabanı hatası oluştu.";
    return false;
}

/**
 * Giriş yapma
 */
function loginUser(string $email, string $password, array &$errors): bool
{
    $pdo = getPDO();
    $errors = [];

    if (trim($email) === '' || trim($password) === '') {
        $errors[] = "E-posta ve şifre boş olamaz.";
        return false;
    }

    // Kullanıcıyı getir
    $stmt = $pdo->prepare("SELECT id, name, password_hash FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $row = $stmt->fetch();

    if (!$row || !password_verify($password, $row['password_hash'])) {
        $errors[] = "E-posta veya şifre hatalı.";
        return false;
    }

    // Session başlat
    $_SESSION['user_id'] = $row['id'];
    
    setFlashMessage('success', 'Giriş başarılı! Hoş geldiniz, ' . htmlspecialchars($row['name']));
    return true;
}

/**
 * Çıkış yapma
 */
function logoutUser()
{
    $_SESSION = [];
    session_destroy();

    setFlashMessage('success', 'Başarıyla çıkış yaptınız.');
}

/**
 * Kullanıcı adını güncelleme
 */
function updateUserName(int $userId, string $newName, array &$errors): bool
{
    $pdo = getPDO();
    $errors = [];

    if (trim($newName) === '') {
        $errors[] = "Ad alanı boş bırakılamaz.";
        return false;
    }

    $stmt = $pdo->prepare("UPDATE users SET name = ? WHERE id = ?");
    $stmt->execute([$newName, $userId]);
    
    setFlashMessage('success', 'Adınız başarıyla güncellendi.');
    return true;
}

/**
 * Kullanıcı şifresini güncelleme
 */
function updatePassword(int $userId, string $currentPassword, string $newPassword, string $newPasswordAgain, array &$errors): bool
{
    $pdo = getPDO();
    $errors = [];

    if ($newPassword !== $newPasswordAgain) {
        $errors[] = "Yeni şifreler birbiriyle uyuşmuyor.";
        return false;
    }

    if (strlen($newPassword) < 6) {
        $errors[] = "Yeni şifre en az 6 karakter olmalıdır.";
        return false;
    }

    // Mevcut şifreyi kontrol et (DB'deki hash ile)
    $stmt = $pdo->prepare("SELECT id, password_hash FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $row = $stmt->fetch();

    if (!$row || !password_verify($currentPassword, $row['password_hash'])) {
        $errors[] = "Mevcut şifreniz hatalı.";
        return false;
    }

    // Yeni şifreyi hash'le ve güncelle
    $newHash = password_hash($newPassword, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
    $stmt->execute([$newHash, $userId]);

   
    setFlashMessage('success', 'Şifreniz başarıyla güncellendi.');
    return true;
}

/**
 * Flash mesajı ayarlar (yönlendirmeler arası mesaj taşımak için)
 */
function setFlashMessage(string $type, string $message): void
{
    if (!isset($_SESSION['flash'])) {
        $_SESSION['flash'] = [];
    }
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

/**
 * Flash mesajını alır ve temizler
 */
function getFlashMessage(): ?array
{
    if (isset($_SESSION['flash'])) {
        $message = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $message;
    }
    return null;
}