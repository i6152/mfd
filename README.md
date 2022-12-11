# mfd

Veritabanı işlemleri sanal olarak _db dizini altında her content kendi php sayfasından çalışacak şekilde fn'ler halinde tutulmuştur.

İlk olarak sayfalar _db/menu.php altından tanımlanıyor buradaki içerikler 4 5 tabloya ayrılması gerekiyor.. 
*embed
*db içerikleri
*sayfa baslik ve link bilgileri
*lang
*template


_components dizini sayfa içi component'leri oluşturduğumuz kısım. hata sayfaları mantık olarak _pages altınada alınabilir fakat ben main kısmına components olarak kullanmayı planladığım için _pages altına almadım eğer direk 404 sayfası açılacak ise fn'ye props olarak html yükletmek istediğinizi söylemeniz ve fonksiyon içini düzenlemeniz yeterli olacaktır..
*_components/index.php -> bütün sayfaları tek yerde toparlamak için yapılmıştır.
**_components/[header, footer, subMenu, breadCrumb]/index.php -> burada var olan kullanılabilir tasarımların listesi tutuluyor ve bunlar üzerinden _defined.php de include ve fn_exist kontrolü ile index php de çağrılıyor. istenirse fn_exist _defined.php ye taşınıp fn_exist ile atama yapılabilir ve index.php de direk fn() yapılabilir size kalmış.
**_components/[header, footer, subMenu, breadCrumb]/[tasarim].php -> burada tasarımlar yapılıyor özgürce fn class tarzı şeyler kullanabilirsiniz final'de ilgili list sayfasına tek fn vermeniz yeterli olacaktır. fn dışı bir kod yazarsanız sayfaları bozabilirsiniz FN DIŞI GLOBAL BİŞİ KULLANMAYINIZ...


_db/ -> localde bir db mantığı ile çalışıyor ve her sayfanın kendisine ait bir php sayfası vardır bunun içinde fgc, curl, db, dizi işlemleri yapabilir ve response dönebilirsiniz. burayı sadece _defined.php sayfasında kullandım ama farklı sayfalarda da kullanabilirsiniz...
* _db/sayfaIcerigi.php -> burada bir sayfanın main sayfasını tanımlıyoruz ve istenirse sayfalara özel alanlar açılıp çağrılabilir. ek olarak header, footer vs. için bir id tutup temaların dışında ekstra alanlar çağrılabilir.
* _db/temalar.php -> burada temalar oluşturup id ler ile _components/[**]/index.php lerdeki id leri bağlıyoruz. 

_pages/ -> burası main kısmında çağrılacak kod sayfası burada fn ve class dışı global içerikler kullanabilirsiniz, veya detay anasayfa gibi kontroller yapıp sayfa içeriğini çalıştırabilirsiniz, dilerseniz anasayfada subMenu çalıştırıldı onu bu kısımda çalıştırabilirsiniz...


.htaccess -> olabildiğince minimal tutmaya çalıştım dilediğiniz gibi başına kural yazarak çoğaltabilirsiniz. 
** haberler/[***]
** blog/[***]


./function.php -> basit 3 4 fonksiyon var global fonksiyonları direk buraya yazarsanız her sayfada kullanabilirsiniz


./_defined.php -> projeyi ayağa kaldıran kısım burasıdır. içindekiler 
*** Dil Ayarları
*** Sayfa Bulma
*** Detay Sayfa Bulma ve İçerikleri Çekme 
*** SEO İşlemleri
*** BreadCrumb Oluştur
*** Component Listesi
*** Css Jss List


./index.php
*** siteye her gelen kullanıcının ilk göreceği sayfa bu sayfa olmalıdır..... htaccess veya farklı kod yapısında php sayfaları oluştururken dikkat ediniz..
*** bütün istekler index.php den yönetileceği için burayı fazla şişirmeden sayfalara bölerek işlemler yapmaya çalıştım.
** burada ilk girişte 4 php include sayfası mevcuttur.
** temaya uygun olarak html head body vs. içeriğini düzenleyebilirsiniz.
** head ve footer içinde _defined.php(default + menuler.php) tarafından oluşturulan css js içerikleri yükleniyor.
** [header, footer, subMenu, breadCrumb] gibi içerikleri ilgili yerlerde include ve fn_exist yapıp çağırıyoruz.
* buraya base_url sonradan eklendi ilk başta _defined.php girişinde ilk işlemdi fakat function.php de lazım olduğu için en başa aldım daha sonra bunu ayrı bir sayfaya alıp tanımlamalar.php tarzı bir sayfa oluşturabilir içinde iletişim bilgileri, default ayarlar vs. tutulabilir.



Yeni Sayfa Oluşturmak İçin
* _db/menu.php -> sayfayı oluştur
* _db/sayfaIcerigi.php -> sayfanın main alanını ayarla ve diğer custom içerikleri tanımlayabilirsin. şu anda customlar çalışmıyor ama ayarlanması kullanım kolaylığı sağlayacaktır. bu alanlar temanın dışına çıkmanızı sağlayacaktır.
** _db/sayfaIcerigi.php > $list['dosya'] -> bu alana yazılan dosya isminde dosya oluşturup orada tasarım ve içeriklerinizi yapabilirsiniz...
* sonrası _defined.php üzerinde otomatik olarak oluşmaktadır belki sayfa içeriğine göre müdahale etmeniz gerekebilir.
*** muhtemelen ben doğrusu muhtemelen mi muhtemelemen mi diye düşünürken siz sayfayı oluşturup çalıştırmışsınızdır :)) ***
 

Not: projede sadece hakkimizda ve blog sayfası hazırlanmıştır. 


Not: _components/subMenu -> ilk başta sayfa içi sağ sol küçük menü tarzı düşünülüp oluşturuldu fakat sonradan esnekliğini göstermek için footer newsletter çevirdim... buraya dilerseniz menu.php den bir newsletter parametresi yollayıp istediğiniz sayfada gösterip istediğiniz sayfada gizleyebilirsiniz.

Not: cms kolaylığını görmek için _db/temalar.php den header=> [1 || 2] şeklinde değiştirip iki farklı header çalışmasını görebilirsiniz dosyalar _components/header/[1=>ornek.php, 2=>demo.php] olarak ayarlanmıştır...