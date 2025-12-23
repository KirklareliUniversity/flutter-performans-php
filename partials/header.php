<?php
// header.php
// index.php'den gelen $sayfa değişkenini $current olarak kullanıyoruz.
// Bu, "Undefined variable $current" hatasını çözer.
$current = $sayfa ?? 'welcome';
$user = currentUser();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <?php 
        $pageTitleMap = [
            'welcome' => 'Hoş Geldiniz', 
            'anasayfa' => 'Ana Sayfa',
            'jank-nedir' => 'Jank Nedir?',
            'devtools' => 'DevTools Analizi',
            'teknikler' => 'Optimizasyon Teknikleri',
            'kod-ornekleri' => 'Kod Örnekleri',
            'gorseller' => 'Uygulama Görselleri',
            'giris' => 'Giriş Yap',
            'kayit' => 'Kayıt Ol',
            'profil' => 'Profil'
        ];
        $displayTitle = $pageTitleMap[$current] ?? 'Flutter Performans Projesi';
    ?>
    <title><?= htmlspecialchars($displayTitle) ?> | Flutter Performans Projesi</title>
    <link rel="stylesheet" href="style.css"> 

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/monokai.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/dart.min.js"></script>
    <script>
        // Sayfa yüklendiğinde renklendirmeyi başlat
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('pre code').forEach((el) => {
                hljs.highlightElement(el);
            });
        });
    </script>
</head>
<body>

<header>
    <h1>Flutter Performans Optimizasyonu &amp; Jank Azaltma</h1>
    <p>Mobil Programlama Dersi Proje Sunumu | PHP - MySQL Tabanlı Web Anlatım Projesi</p> 
</header>

<nav>
    <ul>
        <li><a href="index.php?sayfa=anasayfa" class="<?= $current == 'anasayfa' ? 'aktif' : '' ?>">Ana Sayfa</a></li>
        <li><a href="index.php?sayfa=jank-nedir" class="<?= $current == 'jank-nedir' ? 'aktif' : '' ?>">Jank Nedir?</a></li>
        <li><a href="index.php?sayfa=devtools" class="<?= $current == 'devtools' ? 'aktif' : '' ?>">DevTools ile Analiz</a></li>
        <li><a href="index.php?sayfa=teknikler" class="<?= $current == 'teknikler' ? 'aktif' : '' ?>">Optimizasyon Teknikleri</a></li>
        
        <?php if ($user): // Kullanıcı giriş yaptıysa bu sayfaları göster ?>
            <li><a href="index.php?sayfa=kod-ornekleri" class="<?= $current == 'kod-ornekleri' ? 'aktif' : '' ?>">Kod Örnekleri</a></li>
            <li><a href="index.php?sayfa=gorseller" class="<?= $current == 'gorseller' ? 'aktif' : '' ?>">Görseller</a></li>
        <?php endif; ?>

        <?php if ($user): ?>
            <li style="margin-left:auto;"><span style="padding: 12px 8px; font-size: 15px;">Merhaba, <?= htmlspecialchars($user['name']) ?></span></li>
            <li><a href="index.php?sayfa=profil" class="<?= $current == 'profil' ? 'aktif' : '' ?>">Profil</a></li>
            <li><a href="index.php?sayfa=cikis" class="<?= $current == 'cikis' ? 'aktif' : '' ?>">Çıkış Yap</a></li>
        <?php else: ?>
            <li style="margin-left:auto;"><a href="index.php?sayfa=giris" class="<?= $current == 'giris' ? 'aktif' : '' ?>">Giriş Yap</a></li>
            <li><a href="index.php?sayfa=kayit" class="<?= $current == 'kayit' ? 'aktif' : '' ?>">Kayıt Ol</a></li>
        <?php endif; ?>
    </ul>
</nav>

<div class="container">
<?php 
// Flash mesajı var mı kontrol et ve göster
$flash = getFlashMessage();
if ($flash): 
?>
    <div class="flash-message <?= htmlspecialchars($flash['type']) ?>">
        <?= htmlspecialchars($flash['message']) ?>
    </div>
<?php endif; ?>