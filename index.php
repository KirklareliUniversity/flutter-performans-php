<?php
// index.php – Ana Denetleyici (Router) ve Yetkilendirme Kontrolü
// Amacım: Sitenin tüm trafiğini yönetmek, kullanıcı yetkisini kontrol etmek ve doğru sayfayı yüklemek.

// KRİTİK HATA GİDERME: Veritabanı (db.php) bağlantısını sadece auth.php üzerinden dahil ettim.
// Böylece getPDO() fonksiyonunun iki kez tanımlanması (Fatal Error) engellendi.
require __DIR__ . '/auth.php'; 

// Varsayılan sayfa ataması: URL'de ?sayfa= parametresi yoksa siteyi ilk açılışta
// yeni eklediğimiz 'welcome' sayfasına yönlendiriyorum.
$sayfa = $_GET['sayfa'] ?? 'welcome';

// Kullanıcının oturum durumunu kontrol ediyorum.
$user = currentUser(); 

// 1. Herkesin Erişebildiği Sayfalar (Halka Açık)
// Bu sayfalar giriş yapmaya gerek kalmadan görüntülenebilir.
$halkaAcikSayfalar = [
    'welcome',
    'anasayfa',
    'jank-nedir',
    'devtools',
    'teknikler',
    'giris',
    'kayit',
    'cikis'
];

// 2. Sadece Giriş Yapmış Kullanıcıların Erişebildiği Sayfalar (Korumalı)
// Bu sayfalar sadece $user değişkeni doluysa görüntülenebilir.
$korumaliSayfalar = [
    'kod-ornekleri',
    'gorseller',
    'profil'
];

// Sayfa kontrolü: Korumalı bir sayfaya girmeye çalışıyorsa ve giriş yapmamışsa
// Güvenliği sağlamak için kullanıcıyı 'giris' sayfasına yönlendiriyorum.
if (in_array($sayfa, $korumaliSayfalar) && !$user) {
    setFlashMessage('error', 'Bu sayfaya erişim için giriş yapmalısınız.');
    header('Location: index.php?sayfa=giris');
    exit;
}

// Güvenlik kontrolü: Eğer URL'deki sayfa, tanımlı (halka açık veya korumalı) dizilerde yoksa
// Geçersiz URL girişimlerini engelliyor ve kullanıcıyı 'anasayfa'ya yönlendiriyorum.
if (!in_array($sayfa, $halkaAcikSayfalar) && !in_array($sayfa, $korumaliSayfalar)) {
    $sayfa = 'anasayfa';
}

// TEMPLATE YÜKLEME AŞAMASI
// Header, Navigasyon ve Açılan Flash Mesajlarını ekliyorum.
require 'partials/header.php';

// Sayfa içeriğini yükle (Dynamic Page Loading)
// Oluşturduğumuz $sayfa değişkeni ile pages klasöründeki dosyayı çağırıyorum.
if (file_exists("pages/{$sayfa}.php")) {
    require "pages/{$sayfa}.php";
} else {
    // Çok nadir bir hata olursa (dosya adı yanlış yazılırsa vb.) anasayfayı yedek olarak yüklüyorum.
    require "pages/anasayfa.php";
}

// Footer'ı ve kapanış etiketlerini ekliyorum.
require 'partials/footer.php';