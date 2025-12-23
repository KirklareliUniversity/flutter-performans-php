<?php $pageTitle = "DevTools ile Performans Analizi"; ?>
<h2>Flutter DevTools ile Performans Analizi</h2>

<p>
    Flutter DevTools, hem UI render sürecini hem de CPU yükünü ayrıntılı bir şekilde izlemeye imkân tanıdığı için performans optimizasyonlarında kritik bir role sahiptir. Projemizdeki jank'ın nedenlerini gözlemlemek ve optimize edilmiş sürümdeki iyileşmeleri karşılaştırmalı biçimde açıklamak için bu araçlar kullanılmıştır.
</p>

<div class="info-grid">
    <div class="info-card">
        <h3 style="color: var(--flutter-blue);">1. Performance Timeline (Zaman Çizelgesi) Analizi</h3>
        <p>
            Performance sekmesi, uygulamanın ürettiği karelerin zaman çizelgesi üzerinde gösterildiği analiz panelidir. <strong>16.6 ms sınırını aşan kareler jank olarak kabul edilir.</strong>
        </p>
        
        <h4>Yavaş Sürüm (SlowListPage) Gözlemleri:</h4>
        <ul>
            <li>Ağır CPU işlemleri (örneğin, <code>heavyWork()</code>), her liste elemanı oluşturulurken tetiklendiği için kare sürelerinde düzensiz sıçramalar görülmüştür.</li>
            <li>Timeline üzerinde kırmızı renkli uyarı barları (jank anları) belirmiştir. </li>
        </ul>
        
        <h4>Optimize Sürüm (FastListPage) İyileşmeleri:</h4>
        <ul>
            <li><code>ListView.builder</code> kullanımı sayesinde CPU yükü büyük ölçüde azalmıştır.</li>
            <li>Kare sürelerinin daha istikrarlı ve düşük değerde seyrettiği görülmüştür.</li>
        </ul>
    </div>
    
    <div class="info-card">
        <h3 style="color: var(--flutter-blue);">2. Repaint Rainbow Analizi</h3>
        <p>
            Repaint Rainbow, ekranda hangi widget’ların yeniden çizildiğini renklerle gösteren bir görselleştirme aracıdır. Çok sık yanıp sönen alanlar, optimize edilmesi gereken bölgelerdir.
        </p>
        
        <h4>Yavaş Sürüm Gözlemleri:</h4>
        <ul>
            <li><code>ListView</code> yapısı optimize edilmediği için scroll işlemi sırasında tüm liste alanı yeniden çizilmiştir.</li>
            <li>Repaint Rainbow sürekli ve yoğun şekilde yanıp sönerek performans kaybını net biçimde göstermiştir.</li>
        </ul>

        <h4>Optimize Sürümde [RepaintBoundary] Etkisi:</h4>
        <ul>
            <li><code>RepaintBoundary</code> kullanılarak her satır bağımsız bir çizim alanına dönüştürülmüştür.</li>
            <li>Scroll sırasında yalnızca ekrana giren–çıkan widget'lar yeniden çizilmiş, Repaint bölgeleri belirgin şekilde daralmıştır. </li>
        </ul>
    </div>
</div>

<h3 style="margin-top: 35px; color: var(--flutter-blue);">3. Widget Rebuild Analizi ve const Kullanımı</h3>
<p>
    Widget Rebuild Analizi, hangi widget’ların ne sıklıkla baştan oluşturulduğunu gösterir. Gereksiz rebuild işlemleri performans kayıplarının önemli bir nedenidir.
</p>

<div class="info-grid">
    <div class="info-card comparison-column bad" style="border-left-color: var(--accent-red); padding: 20px;">
        <h4 style="color: var(--accent-red); margin-top: 0;">Yavaş Sürümde Tespit Edilen Problemler</h4>
        <ul>
            <li>Normal <code>ListView</code> kullanımı sebebiyle tüm liste elemanları baştan oluşturulmuştur.</li>
            <li>Sabit yapıda olan bileşenlerde <code>const</code> kullanılmadığı için gereksiz rebuild işlemleri artmıştır.</li>
        </ul>
    </div>

    <div class="info-card comparison-column good" style="border-left-color: #2e7d32; padding: 20px;">
        <h4 style="color: #2e7d32; margin-top: 0;">Optimize Sürümde Yapılan İyileştirmeler</h4>
        <ul>
            <li><code>const</code> widget kullanımı, değişmeyen bileşenlerin yeniden oluşturulmasını engellemiştir.</li>
            <li><code>ListView.builder</code>, yalnızca ekranda görünen elemanları üreterek rebuild yükünü dramatik şekilde azaltmıştır.</li>
            <li>Rebuild Analyzer üzerinde yeniden oluşturulan widget sayısının ciddi oranda düştüğü gözlemlenmiştir.</li>
        </ul>
    </div>
</div>

<p style="margin-top: 30px;">
    <strong>Genel Değerlendirme:</strong> Rebuild optimizasyonları, CPU ve render yükünü azaltarak uygulamanın daha kararlı bir performans sergilemesini sağlamıştır. Flutter DevTools, optimizasyon adımlarının performans üzerinde doğrudan etkili olduğunu açıkça göstermektedir.
</p>