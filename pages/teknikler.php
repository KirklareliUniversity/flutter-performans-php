<?php $pageTitle = "Optimizasyon Teknikleri"; ?>
<h2>Uygulanan Optimizasyon Teknikleri</h2>
<p>
    Bu projede, jank problemini azaltmak ve uygulamanın kaydırma performansını iyileştirmek için dört temel optimizasyon yaklaşımı uygulanmıştır. Bu teknikler, Flutter uygulamalarında gereksiz render, yeniden oluşturma (rebuild) ve yeniden çizim (repaint) işlemlerinin azaltılmasını hedeflemekte olup UI thread üzerindeki yükü doğrudan hafifletmektedir.
</p>

<div class="info-grid">

    <div class="info-card">
        <h3 style="color: var(--flutter-blue);">1. const Widget Kullanımı</h3>
        <p>
            Flutter’da <code>const</code> ile tanımlanan widget’lar değişmez (immutable) kabul edilir ve uygulama çalıştığı sürece bellekte tek bir örnek olarak saklanır. Bu durum, Flutter’ın widget ağacını oluştururken aynı widget’ın tekrar tekrar yeniden oluşturulmasını engeller.
        </p>
        <p><strong>Temel Katkıları:</strong></p>
        <ul>
            <li>Gereksiz rebuild işlemlerinin önüne geçilir.</li>
            <li>Özellikle statik içerikli geniş listelerde performans iyileşmesi sağlanır.</li>
            <li>Render süresi azalır, UI thread üzerindeki işlem yoğunluğu düşer.</li>
        </ul>
        <pre><code>// Optimize edilmiş FastListPage'den örnek:
trailing: const Icon(Icons.check_circle, color: Colors.green),
subtitle: const Text("Optimize edilmiş, jank yok"),</code></pre>
        <p>Optimize edilmiş sürümde sabit widget’lar <code>const</code> ile işaretlenmiş ve performans artışı elde edilmiştir.</p>
    </div>

    <div class="info-card">
        <h3 style="color: var(--flutter-blue);">2. RepaintBoundary Kullanımı</h3>
        <p>
            <code>RepaintBoundary</code>, widget ağacını bağımsız çizim alanlarına ayırarak yalnızca değişiklik olan bileşenin yeniden çizilmesini sağlar. Bu yaklaşım GPU üzerindeki yükü azaltır ve çok elemanlı listelerde önemli performans kazancı sağlar. 
        </p>
        <p><strong>Tekniğin Katkıları:</strong></p>
        <ul>
            <li>Tüm liste yerine sadece ilgili satır yeniden çizilir.</li>
            <li>Scroll sırasında ekranın tamamı repaint edilmez.</li>
            <li>GPU yükü azalır, kare süreleri iyileşir.</li>
        </ul>
        <pre><code>// ListView.builder içinde her eleman RepaintBoundary ile sarılır
return RepaintBoundary(
    child: Card(
        // ... ListTile içeriği ...
    ),
);</code></pre>
        <p>Optimize sürümde her liste elemanı RepaintBoundary içerisine alınmıştır.</p>
    </div>

    <div class="info-card">
        <h3 style="color: var(--flutter-blue);">3. ListView.builder ile Dinamik Liste</h3>
        <p>
            Statik <code>ListView</code> yapısı, tüm liste elemanlarını uygulama başında oluşturur, bu da yüksek bellek kullanımı ve gereksiz render üretir. Buna karşın, <code>ListView.builder</code> yalnızca ekranda görünen elemanları oluşturur. 
        </p>
        <p>Kullanıcı scroll ettikçe, diğer elemanlar dinamik olarak oluşturulup, görünmeyenler yok edilir.</p>
        <p><strong>Performansa Katkıları:</strong></p>
        <ul>
            <li>Bellek kullanımı azalır.</li>
            <li>İlk açılışta render süresi kısalır.</li>
            <li>Büyük listelerde jank oluşumu engellenir.</li>
        </ul>
        <p>Optimize edilmiş uygulamada liste yapısı tamamen <code>ListView.builder</code> üzerine geçirilmiştir.</p>
    </div>

    <div class="info-card">
        <h3 style="color: var(--flutter-blue);">4. Ağır İşlemleri Isolate Üzerine Taşıma (Teorik)</h3>
        <p>
            Flutter’da ana thread (UI thread), arayüzü oluşturmak ve animasyonları yönetmekle sorumludur. CPU yoğunluklu hesaplamaların bu thread üzerinde çalıştırılması doğrudan kare sürelerinin artmasına ve jank oluşmasına neden olur.
        </p>
        <p>
            Bunun çözümü ağır işlemleri <strong>Isolate</strong> yapısı üzerinde çalıştırmaktır. Isolate’lar paralel thread mantığıyla çalışır ve UI thread’inden tamamen ayrıdır. 
        </p>
        <p><strong>Yaklaşımın Katkıları:</strong></p>
        <ul>
            <li>UI thread bloke edilmez.</li>
            <li>Hesaplama süresi uzun olsa bile arayüz akıcı kalır.</li>
            <li>Özellikle gerçek zamanlı scroll veya animasyonlarda stabilite sağlanır.</li>
        </ul>
        <p>Bu proje teorik olarak Isolate kullanımını içermekte olup, ağır işlem yükünün UI’dan ayrılması gerektiğini göstermektedir.</p>
    </div>

</div>

<p style="margin-top: 30px;">
    <strong>Değerlendirme:</strong> Uygulanan bu dört temel teknik, Flutter uygulamalarında yüksek performanslı ve akıcı kullanıcı deneyimi elde etmek için atılacak kritik adımlardır.
</p>