<h2>Flutter Performansı ve Jank Kavramı</h2>

<p>
    Flutter, UI bileşenlerini çizmek için kendi rendering motoru olan Skia’yı kullanır. Akıcı bir kullanıcı deneyimi
    için saniyede <strong>60 FPS</strong> (Frame Per Second) hedeflenir.
</p>

<h3>16.6 Milisaniye Kuralı</h3>

<div class="info-grid">
    <div class="info-card" style="border-left: 5px solid var(--flutter-blue);">
        <h4 style="color: var(--flutter-blue); margin-top: 0; font-size: 18px;">Akıcılık Hedefi</h4>
        <p>60 FPS akıcılığını sağlayabilmek için, her bir karenin (frame) hazırlık ve çizim süresi maksimum <strong>16.6 ms</strong> (milisaniye) olmalıdır.</p>
        <p style="margin-top: 15px;"><strong>Jank Nedir?</strong> Eğer işlemler bu süreyi aşarsa kare gecikmeleri yaşanır ve kullanıcı ekranda “takılma” veya “donma” hisseder. Bu durum <strong>Jank</strong> olarak tanımlanır.</p>
        
        <p style="text-align: center; margin-top: 20px;">
            
        </p>
    </div>

    <div class="info-card" style="border-left: 5px solid var(--accent-red);">
        <h4 style="color: var(--accent-red); margin-top: 0; font-size: 18px;">SlowListPage: Jank'in Kasıtlı Örneği</h4>
        <p>
            Projede jank sorununu göstermek için <strong>SlowListPage</strong> adında kasıtlı olarak yavaş çalışan bir ekran tasarlandı. Bu ekranda, UI thread'i uzun süre meşgul eden <strong>20 milyon döngülü ağır bir CPU fonksiyonu</strong> kullanıldı.
        </p>
        <pre><code>int heavyWork(int x) {
    // ... 20 milyon döngü UI thread'i bloklar ...
}</code></pre>
        <p>
            Bu yapı, DevTools'ta kare sürelerinin <strong>40–100 ms</strong> seviyelerine çıkmasına ve yoğun jank oluşmasına neden oldu.
        </p>
    </div>
</div>

<h3 style="margin-top: 35px;">Jank Oluşma Nedenleri (Hata Kaynakları)</h3>

<div class="info-grid">
    <div class="info-card">
        <h4 style="color: var(--accent-red); margin-top: 0;">1. CPU İş Yükü</h4>
        <ul>
            <li>Büyük listeleri hesaplamak, JSON parse etme veya karmaşık hesaplamalar gibi ağır işlemlerin ana thread üzerinde çalıştırılması.</li>
            <li>Bu, UI thread'ini bloke ederek karelerin render edilmesini engeller.</li>
        </ul>
    </div>
    <div class="info-card">
        <h4 style="color: var(--accent-red); margin-top: 0;">2. Yanlış Liste Yapısı</h4>
        <ul>
            <li>Tüm widget’ları aynı anda oluşturan statik <code>ListView</code> kullanımı. (500 eleman varsa 500'ü de hemen oluşturulur.)</li>
            <li>Çözüm: Yalnızca görünen elemanları oluşturan <code>ListView.builder</code> kullanılmaması.</li>
        </ul>
    </div>
    <div class="info-card">
        <h4 style="color: var(--accent-red); margin-top: 0;">3. Gereksiz Yenileme (Rebuild/Repaint)</h4>
        <ul>
            <li><code>const</code> anahtar kelimesi eksikliği nedeniyle widget’ların gereksiz yere rebuild edilmesi.</li>
            <li><code>RepaintBoundary</code> eksikliği: Üst seviyedeki küçük değişikliklerin alt seviyedeki geniş widget alanlarını gereksiz yere yeniden çizmesi.</li>
        </ul>
    </div>
    <div class="info-card">
        <h4 style="color: var(--accent-red); margin-top: 0;">4. Görsel Bellek Yükü</h4>
        <ul>
            <li>Yüksek çözünürlüklü ve büyük görsel dosyalarının kullanılması.</li>
            <li>Bu dosyaların decode süreci, ana thread üzerinde uzun sürerek takılmalara yol açabilir.</li>
        </ul>
    </div>
</div>

<p style="margin-top: 30px;">
    Bu projede jank sorunları bu nedenler ışığında analiz edilmiş, <strong>FastListPage</strong> ekranında 
    çeşitli optimizasyonlar uygulanarak aynı verinin çok daha akıcı gösterilebildiği ortaya konmuştur. 
    Detaylı inceleme için lütfen <strong>“DevTools ile Analiz”</strong> ve <strong>“Optimizasyon Teknikleri”</strong> sayfalarını ziyaret edin.
</p>