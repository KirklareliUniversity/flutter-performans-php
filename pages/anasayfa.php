<div class="hero">
    <h2 style="color:white; font-size: 32px; padding:0; border:none; margin-bottom: 15px;">
        Performans Optimizasyonunun Web'e Sunumu
    </h2>
    <p class="hero-sub" style="font-size: 18px; color: #f0f0f0;">
        Bu web sitesi, Mobil Programlama dersi kapsamında geliştirilen Flutter optimizasyon projesinin teknik analizlerini, kod örneklerini ve performans kanıtlarını web ortamında sergilemek için hazırlanmıştır.
    </p>
</div>
<h3>Projenin Amacı ve 60 FPS Hedefi</h3>
<p>
    Mobil uygulamalarda akıcılık için saniyede <strong>60 kare (Frame Per Second - FPS)</strong> hedeflenir. Bu, her bir karenin <strong>yaklaşık 16.6 ms</strong> içinde işlenmesi gerektiği anlamına gelir. 
</p>
<p>
    Projemizdeki temel amaç, Flutter uygulamalarında bu sürenin aşılmasıyla sıkça karşılaşılan <strong>jank (ekran takılmaları)</strong> problemini basit ama etkili bir senaryo üzerinden göstermek ve performansı artırmak için kullanılan teknikleri uygulamalı olarak ortaya koymaktır.
</p>

<div class="comparison-box">
    
    <div class="comparison-column bad">
        <h4 style="color: #E03C3C;">SlowListPage (Jank'li Sürüm)</h4>
        <p><strong>Neden Yavaş?</strong></p>
        <ul>
            <li>CPU'yu kilitleyen ağır <code>heavyWork()</code> fonksiyonu.</li>
            <li>Normal <code>ListView</code> ile 500 elemanın tamamının baştan oluşturulması.</li>
            <li><code>const</code> kullanılmadığı için gereksiz rebuild maliyeti.</li>
            <li>DevTools'ta sürekli <strong>kırmızı jank çubukları</strong>.</li>
        </ul>
    </div>

    <div class="comparison-column good">
        <h4 style="color: #2e7d32;">FastListPage (Optimize Sürüm)</h4>
        <p><strong>Uygulanan Optimizasyonlar:</strong></p>
        <ul>
            <li>Liste için sanallaştırma sağlayan <code>ListView.builder</code> kullanımı.</li>
            <li>Yeniden çizim alanını sınırlayan <code>RepaintBoundary</code> kullanımı.</li>
            <li>Değişmeyen widget'larda **<code>const</code>** anahtar kelimesi kullanımı.</li>
            <li>Akıcı kaydırma (scrolling) ve stabil 16 ms kare süreleri.</li>
        </ul>
    </div>
</div>
<div class="info-grid">
    <div class="info-card">
        <h3>İçerik Analizi</h3>
        <ul>
            <li>Jank nedir? ve Flutter’da 16.6 ms kuralı.</li>
            <li>SlowListPage'in DevTools Timeline'da yarattığı kırmızı çubuklar.</li>
            <li>Optimize sürümde ListView.builder ve RepaintBoundary etkileri.</li>
            <li>Ağır işlemlerin Isolate'e taşınması (Teorik).</li>
        </ul>
        <p>
            Ayrıntılar için üst menüden <strong>“Jank Nedir?”</strong>, <strong>“DevTools ile Analiz”</strong> ve <strong>“Optimizasyon Teknikleri”</strong> sayfalarına geçiş yapabilirsiniz.
        </p>
    </div>

    <div class="info-card">
        <h3>Projenin Amacı ve Farkındalık</h3>
        <p>
            Modern mobil uygulamalarda kullanıcılar, sadece fonksiyonel değil,
            aynı zamanda <strong>akıcı ve hızlı</strong> bir arayüz beklemektedir.
        </p>
        <p>
            Bu proje, Flutter’da jank’in "nasıl oluştuğunu", "nelere bağlı olduğunu" ve
            "hangi tekniklerle azaltılabileceğini" göstermektedir.
        </p>
        <div class="importance-box" style="margin-top:10px; padding: 10px; border:none; background: #fff;">
            <div class="importance-icon" style="font-size: 30px; padding: 5px 10px;">🚀</div>
            <div>
                 <h4 style="margin:0; font-size:16px;">Ana Hedef</h4>
                 <p style="margin:0; font-size:14px;">Performans analizi ve optimizasyon farkındalığı yaratmaktır.</p>
            </div>
        </div>
    </div>
</div>