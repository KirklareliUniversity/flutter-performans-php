<h2>Mobil Uygulama Kod Örnekleri (Flutter)</h2>

<p>
    Bu bölümde Mobil Programlama dersi için hazırlanan Flutter uygulamasında kullanılan
    temel kod yapıları gösterilmektedir. Kodların amacı jank (takılma) oluşturan yapı ile
    optimize edilmiş yapı arasındaki farkı ortaya koymaktır.
</p>


<h3>1. main.dart – Ana Uygulama ve Sayfa Yönlendirme</h3>
<pre>
<code class="language-dart">
<?php
echo htmlspecialchars('
import "package:flutter/material.dart";
import "slow_list_page.dart";
import "fast_list_page.dart";

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: "Jank Demo",
      debugShowCheckedModeBanner: false,
      home: const HomePage(),
    );
  }
}

class HomePage extends StatelessWidget {
  const HomePage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Performans & Jank Demo"),
        centerTitle: true,
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            ElevatedButton(
              onPressed: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (_) => const SlowListPage()),
                );
              },
              child: const Text("Yavaş Liste (Jankli)"),
            ),
            SizedBox(height: 20),
            ElevatedButton(
              onPressed: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (_) => const FastListPage()),
                );
              },
              child: const Text("Hızlı Liste (Optimize)"),
            ),
          ],
        ),
      ),
    );
  }
}
');
?>
</code>
</pre>


<h3>2. slow_list_page.dart – Jank Oluşturan Bilinçli Yavaş Sayfa</h3>
<pre>
<code class="language-dart">
<?php
echo htmlspecialchars('
import "package:flutter/material.dart";

class SlowListPage extends StatelessWidget {
  const SlowListPage({super.key});

  int heavyWork(int x) {
    int sum = 0;
    for (int i = 0; i < 20000000; i++) {
      sum += x;
    }
    return sum;
  }

  @override
  Widget build(BuildContext context) {
    final items = List.generate(500, (i) => i);

    return Scaffold(
      appBar: AppBar(
        title: const Text("Yavaş Liste (Jankli)"),
      ),
      body: ListView(
        children: items.map((index) {
          final result = heavyWork(index);
          return Card(
            margin: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
            child: ListTile(
              title: Text("Eleman $index"),
              subtitle: Text("Hesap sonucu: $result"),
            ),
          );
        }).toList(),
      ),
    );
  }
}
');
?>
</code>
</pre>


<h3>3. fast_list_page.dart – Optimize Edilmiş Hızlı Sayfa</h3>
<pre>
<code class="language-dart">
<?php
echo htmlspecialchars('
import "package:flutter/material.dart";

class FastListPage extends StatelessWidget {
  const FastListPage({super.key});

  @override
  Widget build(BuildContext context) {
    final items = List.generate(500, (i) => i);

    return Scaffold(
      appBar: AppBar(
        title: const Text("Hızlı Liste (Optimize)"),
      ),
      body: ListView.builder(
        itemCount: items.length,
        itemBuilder: (context, index) {
          return RepaintBoundary(
            child: Card(
              margin: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
              child: ListTile(
                title: Text("Eleman $index"),
                subtitle: const Text("Optimize edilmiş, jank yok"),
                trailing: const Icon(Icons.check_circle, color: Colors.green),
              ),
            ),
          );
        },
      ),
    );
  }
}
');
?>
</code>
</pre>