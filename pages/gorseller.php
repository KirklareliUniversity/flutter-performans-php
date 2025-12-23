<div id="gorseller-page">
    <h2>Uygulama Ekran Görüntüleri</h2>

    <p>
        Bu bölümde Mobil Programlama dersi kapsamında hazırlanan Flutter projesinin
        iki temel ekranının ekran görüntüleri yer almaktadır.
    </p>

    <div class="screenshot-grid">
        <div class="screenshot-card">
            <h3 style="color: var(--accent-red);">Yavaş Liste (Jankli Sürüm)</h3>
            <p class="screenshot-desc">
                Bu ekranda ağır CPU işlemleri ve normal <code>ListView</code> kullanımı
                nedeniyle kaydırma sırasında takılmalar (jank) oluşmaktadır. Bu, kullanıcı deneyimini doğrudan bozar.
            </p>

            <img
                src="imgs/slowlist.png"
                alt="Yavaş Liste (Jankli) ekran görüntüsü"
                class="screen-img"
            >

            <p class="screenshot-note">
                • Her satırda <code>heavyWork()</code> çalıştığı için ana thread bloklanır. <br>
                • DevTools’ta kare süreleri 16 ms'nin üzerine çıkarak kırmızı çubuklar görülür.
            </p>
        </div>

        <div class="screenshot-card">
            <h3 style="color: #2e7d32;">Hızlı Liste (Optimize Sürüm)</h3>
            <p class="screenshot-desc">
                Bu ekranda <code>ListView.builder</code> ve <code>RepaintBoundary</code>
                kullanılarak, sadece görünen elemanlar oluşturulmuş, böylece akıcı bir kaydırma deneyimi elde edilmiştir.
            </p>

            <img
                src="imgs/fastlist.png" 
                alt="Hızlı Liste (Optimize) ekran görüntüsü"
                class="screen-img"
            >

            <p class="screenshot-note">
                • Sadece ekrandaki elemanlar oluşturulur, gereksiz rebuild/render azalır. <br>
                • RepaintBoundary sayesinde yalnızca değişen satırlar yeniden çizilir, GPU yükü düşer.
            </p>
        </div>
    </div>
</div>