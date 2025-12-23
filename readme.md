# Flutter Performans & Jank Web Anlatım Projesi

Bu proje, Mobil Programlama dersi kapsamında Flutter ile geliştirilen
“Performans Optimizasyonu ve Jank Azaltma” konulu uygulamanın,
İleri Web Programlama dersi için web ortamında sunulması amacıyla hazırlanmıştır.

Web projesi, Flutter uygulamasındaki teknik kavramları, örnek kodları, performans analizlerini ve optimizasyon yöntemlerini açıklayan çok sayfalı bir PHP tabanlı web sitesidir.

## Amaç

- Flutter'da jank kavramını (ekran takılması) açıklamak,
- SlowListPage ve FastListPage ekranları arasındaki performans farkını özetlemek,
- Kullanılan optimizasyon tekniklerini (ListView.builder, RepaintBoundary, const) tanıtmak,
- Basit bir PHP tabanlı auth (giriş/kayıt/çıkış/şifre güncelleme) mekanizması ekleyerek güvenli oturum yönetimi örneği sunmak,
- Mobil projedeki gerçek Flutter kodlarını web ortamında kod bloklarıyla sergilemek.

## Kullanılan Teknolojiler

- PHP (sunucu tarafı) (Routing, Session ve MySQL PDO işlemleri için)
- HTML / CSS (arayüz)
- XAMPP ve MySQL / Veritabanı ve yerel sunucu ortamı
- Kod blokları renklendirilmesi için Highlight.js kütüphanesi

## Güvenlik ve Veritabanı Özellikleri

Kullanıcı şifreleri veritabanında güvenli bir şekilde hashlenmiş olarak tutulur. PHP Session'lar kullanılarak kullanıcı oturumları yönetilir ve korumalı sayfalara (Kod Örnekleri, Görseller) erişim kısıtlanır. Yönlendirmeler sırasında kullanıcıya anlık bildirimler göstermek için Session tabanlı Flash Messages kullanılmıştır.

## Klasör Yapısı

ileriwebproje/
│ index.php            # Ana yönlendirme dosyası (router)
│ style.css            # Tüm sayfalar için stil dosyası
│ auth.php             # Giriş - kayıt - çıkış - güncelleme fonksiyonları
│ db.php               # MySQL PDO bağlantı ayarları
│ WEB_README.md        # Proje açıklama dosyası
│
├─ imgs/               # Flutter uygulamasına ait ekran görüntüleri
│     slowlist.png
│     fastlist.png
│
├─ partials/
│     header.php       # Menü ve başlık alanı
│     footer.php       # Alt bilgi
│
└─ pages/
      welcome.php         # Açılış Sayfası 
      anasayfa.php        # Genel proje özeti
      jank-nedir.php      # Jank kavramı ve teknik açıklamalar
      devtools.php        # DevTools ile performans analizi
      teknikler.php       # Kullanılan optimizasyon teknikleri
      kod-ornekleri.php   # Flutter kodlarının gösterimi
      gorseller.php       # Uygulama ekran görüntüleri
      giris.php           # Kullanıcı giriş
      kayit.php           # Kayıt formu
      cikis.php           # Oturum sonlandırma
      profil.php          # Kullanıcı profil ekranı

## Proje Sayfalarının İçerik ve Görev Özeti

Proje sayfaları, projenin hem akademik raporunu hem de teknik yetkilendirme sistemini sergilemek üzere ayrılmıştır.

- welcome.php (Halka Açık): Projenin açılış sayfasıdır.
- anasayfa.php (Halka Açık): Projenin genel amacını, Flutter'da 60 FPS (16.6 ms) hedefini ve yavaş/hızlı listelerin temel kıyaslamasını sunar.
- jank-nedir.php (Halka Açık): Jank (ekran takılması) kavramını tanımlar ve jank oluşumuna yol açan 5 temel nedeni açıklar.
- devtools.php (Halka Açık): Flutter DevTools araçlarının performans sorunlarını nasıl tespit ettiğini ve analizlerinizi anlatır.
- teknikler.php (Halka Açık): Jank'i azaltmak için kullanılan optimizasyon yöntemlerini açıklar.
- kod-ornekleri.php (Giriş Zorunlu): Mobil projede kullanılan Dart kodlarını sözdizimi vurgulanmış kod bloklarıyla sergiler.
- gorseller.php (Giriş Zorunlu): Mobil uygulamadan alınan ekran görüntülerini gösterir.
- giris.php (Halka Açık): Kullanıcının sisteme giriş yapmasını sağlar.
- kayit.php (Halka Açık): Yeni bir kullanıcı kaydı alır, şifreyi hashleyerek veritabanına kaydeder.
- profil.php (Giriş Zorunlu): Kullanıcı adını ve şifresini UPDATE sorguları ile günceller.
- cikis.php (Halka Açık): Oturumu sonlandırır ve ana sayfaya yönlendirir.

## Proje Kurulum ve Çalıştırma Kılavuzu

Projenin başarıyla çalışması için bilgisayarınızda XAMPP (veya benzeri bir Apache/MySQL ortamı) kurulu ve çalışan durumda olmalıdır.

### Aşama 1: Ortam Kontrolü ve Dosya Yerleştirme

- XAMPP Kontrol Panelini açın ve Apache ile MySQL servislerini başlatın.
- ileriwebproje klasörünü C:\xampp\htdocs\ içine kopyalayın.
- ileriwebproje.sql dosyasının erişilebilir bir yerde olduğundan emin olun.

### Aşama 2: Veritabanını İçe Aktarma (Import)

- http://localhost/phpmyadmin adresine gidin.
- db.php dosyasında tanımlanan adla boş bir veritabanı oluşturun.
- Import sekmesinden ileriwebproje.sql dosyasını seçip içe aktarın.
- users tablosunun oluştuğunu ve deneme kullanıcılarının eklendiğini kontrol edin.

### Aşama 3: Projeyi Çalıştırma ve Test Etme

- http://localhost/ileriwebproje/ adresinden projeyi açın.
- Kayıt olmayı deneyin.
- Giriş yapın ve Kod Örnekleri sayfasına erişimi test edin.
- Profil sayfasında ad/şifre güncelleyip UPDATE işlemini doğrulayın.

## Kaynakça

- PHP Temelleri & Yönlendirme: https://www.php.net/manual/en/
- Veritabanı Güvenliği (PDO): https://www.php.net/manual/en/book.pdo.php
- Parola Hashleme: https://www.php.net/manual/en/function.password-hash.php
- Web Standartları ve Responsive: https://developer.mozilla.org/en-US/docs/Web
- Highlight.js Kullanımı: https://highlightjs.org/usage/
