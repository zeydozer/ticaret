@extends('index')

<?php

$title =
[
    'hakkimizda' => 'Hakkımızda',
    'kullanim-kosullari' => 'Kullanım Koşulları',
	'gizlilik-politikasi' => 'Gizlilik Politikası',
    'garanti-politikasi' => 'Garanti Politikası',
    'iptal-iade-degisim' => 'İptal / İade ve Değişim',
    'satis-sozlesmesi' => 'Satış Sözleşmesi',
    'uyelik-sozlesmesi' => 'Üyelik Sözleşmesi',
    'on-bilgilendirme-formu' => 'Ön Bilgilendirme Formu',
    'teslimat-kargo' => 'Teslimat ve Kargo',
    'kvkk-beyani' => 'Kişisel Verilerin Korunması Politikası',
];

?>

@section('title', $title[Request::path()])

@section('content')

<?php

$seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true);

$iletisim = json_decode(\App\Ayar::where('tip', 'iletisim')->first()->data, true);

?>

@if (Request::path() == 'hakkimizda')
<div class="container">
    <div class="row user-panel">
        <div id="primary" class="content-area col-xs-12">
            <main id="main" class="site-main" role="main">
                <article id="post-6" class="post-6 page type-page status-publish hentry">
                    <div class="row">
                        <div class="col-12">
                            <header>
                                <h1 class="page-title margin-top">{{ $seo['author'] }} </h1>
                            </header>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-md-6">
                    		<h5>Noone Toys ailesi olarak çocuklarımızın hayal güçlerini, özgüvenlerini, hikayeleştirme yeteneklerini ve konstrüksiyon kurma kabiliyetlerini erken yaşlarda geliştirmenin önemine inanıyoruz. Bu sebeple dünyanın en iyi oyuncaklarını müşterilerimizle buluşturmak istiyoruz.</h5>
                        <h5>Fisher-Price ve Clementoni ürünleriyle bebeklerimizin çocuklukları başlayana kadar motor ve zihinsel becerilerini geliştiren ürünleri sunuyoruz.</h5>
                        <h5>Barbie, Cry Babies ve Baby Alive oyuncaklarıyla kız çocuklarımızın özgüven ve hikayeleştirme yeteneklerini geliştirirken eğlenceli vakit geçirmelerini amaçlıyoruz.</h5>
                        <h5>Hot Wheels arabaları ve oyun setleri ile erkek çocuklarımızın zihinsel ve fiziksel yeteneklerini ön plana çıkartmalarını amaçlıyoruz.</h5>
                        <h5>Satışa sunduğumuz tüm ürünlerin belirli kalite standartlarında olması ön şartımızdır. Kaynağı denetlenemeyen malzemelerle üretilmiş ürünleri satmıyoruz. </h5>
                        <h5></h5>
                    	</div>
                    	<div class="col-md-6">
                            <img src="/img/Noone-Logo-Square.jpg" alt="{{ $seo['author'] }} Hakkında" width="100%" height="100%" style="object-fit: contain;">
                        </div>
                    </div>
                </article>
                <!-- #post-## -->
            </main>
            <!-- #main -->
        </div>
        <!-- #primary -->
    </div>
</div>

<!-- hakkimizda gelecek -->

@elseif (Request::path() == 'kullanim-kosullari')

<div class="container">
    <div class="row user-panel">
        <div id="primary" class="content-area col-xs-12">
            <main id="main" class="site-main" role="main">
                <article id="post-6" class="post-6 page type-page status-publish hentry">
                    <div class="row">
                        <div class="col-md-12">
                            <header>
                                <h1 class="page-title margin-top">Kullanım Koşulları</h1>
                            </header>
                        </div>
                    </div>
                    <p>Bu internet sitesine girmeniz veya bu internet sitesindeki herhangi bir bilgiyi kullanmanız aşağıdaki koşulları kabul ettiğiniz anlamına gelir.</p>
                    <p>Bu internet sitesine girilmesi, sitenin ya da sitedeki bilgilerin ve diğer verilerin programların vs. kullanılması sebebiyle, sözleşmenin ihlali, haksız fiil, ya da başkaca sebeplere binaen, doğabilecek doğrudan ya da dolaylı hiçbir zarardan … sorumlu değildir. …, sözleşmenin ihlali, haksız fiil, ihmal veya diğer sebepler neticesinde; işlemin kesintiye uğraması, hata, ihmal, kesinti hususunda herhangi bir sorumluluk kabul etmez.</p>
                    <p>… işbu site ve site uzantısında mevcut her tür hizmet, ürün, siteyi kullanma koşulları ile sitede sunulan bilgileri önceden bir ihtara gerek olmaksızın değiştirme, siteyi yeniden organize etme, yayını durdurma hakkını saklı tutar. Değişiklikler sitede yayım anında yürürlüğe girer. Sitenin kullanımı ya da siteye giriş ile bu değişiklikler de kabul edilmiş sayılır. Bu koşullar link verilen diğer web sayfaları için de geçerlidir.</p>
                    <p>…, sözleşmenin ihlali, haksız fiil, ihmal veya diğer sebepler neticesinde; işlemin kesintiye uğraması, hata, ihmal, kesinti, silinme, kayıp, işlemin veya iletişimin gecikmesi, bilgisayar virüsü, iletişim hatası, hırsızlık, imha veya izinsiz olarak kayıtlara girilmesi, değiştirilmesi veya kullanılması hususunda herhangi bir sorumluluk kabul etmez.</p>
                    <p>Bu internet sitesi …’in kontrolü altında olmayan başka internet sitelerine bağlantı veya referans içerebilir. …, bu sitelerin içerikleri veya içerdikleri diğer bağlantılardan sorumlu değildir.</p>
                    <p>… bu internet sitesinin genel görünüm ve dizaynı ile internet sitesindeki tüm bilgi, resim, … markası ve diğer markalar, {{ str_replace(['http://', 'https://'], '', url('/')) }} alan adı, logo, ikon, demonstratif, yazılı, elektronik, grafik veya makinede okunabilir şekilde sunulan teknik veriler, bilgisayar yazılımları, uygulanan satış sistemi, iş metodu ve iş modeli de dahil tüm materyallerin (“Materyaller”) ve bunlara ilişkin fikri ve sınai mülkiyet haklarının sahibi veya lisans sahibidir ve yasal koruma altındadır. İnternet sitesinde bulunan hiçbir Materyal; önceden izin alınmadan ve kaynak gösterilmeden, kod ve yazılım da dahil olmak üzere, değiştirilemez, kopyalanamaz, çoğaltılamaz, başka bir lisana çevrilemez, yeniden yayımlanamaz, başka bir bilgisayara yüklenemez, postalanamaz, iletilemez, sunulamaz ya da dağıtılamaz. İnternet sitesinin bütünü veya bir kısmı başka bir internet sitesinde izinsiz olarak kullanılamaz. Aksine hareketler hukuki ve cezai sorumluluğu gerektirir. …’in burada açıkça belirtilmeyen diğer tüm hakları saklıdır.</p>
                    <p>Müşterinin sisteme girdiği tüm bilgilere sadece Müşteri ulaşabilmekte ve bu bilgileri sadece Müşteri değiştirebilmektedir. Bir başkasının bu bilgilere ulaşması ve bunları değiştirmesi mümkün değildir. Ödeme sayfasında istenen kredi kartı bilgileriniz, siteden alışveriş yapan siz değerli müşterilerimizin güvenliğini en üst seviyede tutmak amacıyla hiçbir şekilde {{ str_replace(['http://', 'https://'], '', url('/')) }} veya ona hizmet veren şirketlerin sunucularında tutulmamaktadır. Bu şekilde ödemeye yönelik tüm işlemlerin {{ str_replace(['http://', 'https://'], '', url('/')) }} ara yüzü üzerinden banka ve bilgisayarınız arasında gerçekleşmesi sağlanmaktadır.</p>
                    <p>…, dilediği zaman bu yasal uyarı sayfasının içeriğini güncelleme yetkisini saklı tutmaktadır ve kullanıcılarına siteye her girişte yasal uyarı sayfasını ziyaret etmelerini tavsiye etmektedir.</p>
                </article>
                <!-- #post-## -->
            </main>
            <!-- #main -->
        </div>
        <!-- #primary -->
    </div>
</div>

@elseif (Request::path() == 'gizlilik-politikasi')

<div class="container">
    <div class="row user-panel">
        <div id="primary" class="content-area col-xs-12">
            <main id="main" class="site-main" role="main">
                <article id="post-3" class="post-3 page type-page status-publish hentry">
                    <div class="row">
                        <div class="col-md-12">
                            <header>
                                <h1 class="page-title margin-top">Gizlilik Politikası</h1>
                            </header>
                        </div>
                    </div>
                    <p>Mağazamızda verilen tüm servisler ve … adresinde kayıtlı … firmamıza aittir ve firmamız tarafından işletilir.</p>
                    <p>Firmamız, çeşitli amaçlarla kişisel veriler toplayabilir. Aşağıda, toplanan kişisel verilerin nasıl ve ne şekilde toplandığı, bu verilerin nasıl ve ne şekilde korunduğu belirtilmiştir.</p>
                    <p>Üyelik veya Mağazamız üzerindeki çeşitli form ve anketlerin doldurulması suretiyle üyelerin kendileriyle ilgili bir takım kişisel bilgileri (isim-soy isim, firma bilgileri, telefon, adres veya e-posta adresleri gibi) Mağazamız tarafından işin doğası gereği toplanmaktadır.</p>
                    <p>Firmamız bazı dönemlerde müşterilerine ve üyelerine kampanya bilgileri, yeni ürünler hakkında bilgiler, promosyon teklifleri gönderebilir. Üyelerimiz bu gibi bilgileri alıp almama konusunda her türlü seçimi üye olurken yapabilir, sonrasında üye girişi yaptıktan sonra hesap bilgileri bölümünden bu seçimi değiştirilebilir ya da kendisine gelen bilgilendirme iletisinde ki linkle bildirim yapabilir.</p>
                    <p>Mağazamız üzerinden veya eposta ile gerçekleştirilen onay sürecinde, üyelerimiz tarafından mağazamıza elektronik ortamdan iletilen kişisel bilgiler, Üyelerimiz ile yaptığımız “Kullanıcı Sözleşmesi” ile belirlenen amaçlar ve kapsam dışında üçüncü kişilere açıklanmayacaktır.</p>
                    <p>Sistemle ilgili sorunların tanımlanması ve verilen hizmet ile ilgili çıkabilecek sorunların veya uyuşmazlıkların hızla çözülmesi için, Firmamız, üyelerinin IP adresini kaydetmekte ve bunu kullanmaktadır. IP adresleri, kullanıcıları genel bir şekilde tanımlamak ve kapsamlı demografik bilgi toplamak amacıyla da kullanılabilir.</p>
                    <p>Firmamız, Üyelik Sözleşmesi ile belirlenen amaçlar ve kapsam dışında da, talep edilen bilgileri kendisi veya işbirliği içinde olduğu kişiler tarafından doğrudan pazarlama yapmak amacıyla kullanabilir. Kişisel bilgiler, gerektiğinde kullanıcıyla temas kurmak için de kullanılabilir. Firmamız tarafından talep edilen bilgiler veya kullanıcı tarafından sağlanan bilgiler veya Mağazamız üzerinden yapılan işlemlerle ilgili bilgiler; Firmamız ve işbirliği içinde olduğu kişiler tarafından, “Üyelik Sözleşmesi” ile belirlenen amaçlar ve kapsam dışında da, üyelerimizin kimliği ifşa edilmeden çeşitli istatistiksel değerlendirmeler, veri tabanı oluşturma ve pazar araştırmalarında kullanılabilir.</p>
                    <p>Firmamız, gizli bilgileri kesinlikle özel ve gizli tutmayı, bunu bir sır saklama yükümü olarak addetmeyi ve gizliliğin sağlanması ve sürdürülmesi, gizli bilginin tamamının veya herhangi bir kısmının kamu alanına girmesini veya yetkisiz kullanımını veya üçüncü bir kişiye ifşasını önlemek için gerekli tüm tedbirleri almayı ve gerekli özeni göstermeyi taahhüt etmektedir.</p>
                </article>
                <!-- #post-## -->
            </main>
            <!-- #main -->
        </div>
        <!-- #primary -->
    </div>
</div>

@elseif (Request::path() == 'garanti-politikasi')

<div class="container">
    <div class="row user-panel">
        <div id="primary" class="content-area col-xs-12">
            <main id="main" class="site-main" role="main">
                <article id="post-18" class="post-18 page type-page status-publish hentry">
                    <div class="row">
                        <div class="col-md-12">
                            <header>
                                <h1 class="page-title margin-top">Garanti Politikası</h1>
                            </header>
                        </div>
                    </div>
                    <p>Tüm ürünler aksi belirtilmediği sürece, üretici firmaların garantisi altındadır. Garanti koşullarının geçerli olabilmesi için kargo teslimatı esnasında ürünü mutlaka kontrol ediniz. Herhangi bir hasar gördüğünüzde kargo görevlisine tutanak tutturarak ürünü teslim almayınız. Ürün üzerinde yapılan değişiklikler, ürünün deforme olması ya da ürünün orijinal dizayn / kutu veya ambalajının bozulması garanti kapsamı dışındadır.</p>
                </article>
                <!-- #post-## -->
            </main>
            <!-- #main -->
        </div>
        <!-- #primary -->
    </div>
</div>

@elseif (Request::path() == 'iptal-iade-degisim')

<div class="container">
    <div class="row user-panel">
        <div id="primary" class="content-area col-xs-12">
            <main id="main" class="site-main" role="main">
                <article id="post-20" class="post-20 page type-page status-publish hentry">
                    <div class="row">
                        <div class="col-md-12">
                            <header>
                                <h1 class="page-title margin-top">İptal / İade ve Değişim Politikası</h1>
                            </header>
                        </div>
                    </div>
                    <p><strong>DEĞİŞİM</strong></p>
                    <p><strong>Ürünlerde Değişim Süresi Ne Kadar?</strong></p>
                    <p>{{ str_replace(['http://', 'https://'], '', url('/')) }} adresinden satın almış olduğunuz ürünlerin kullanılmamış olması şartıyla değişim süresi fatura tarihinden itibaren “15 GÜN”dür.</p>
                    <p><strong>Değişim İşlemini Nasıl Gerçekleştirebilirim?</strong></p>
                    <p>1- Değişimini yapmak istediğiniz ürün/ürünleri faturası ile beraber, fatura üzerinde bulunan merkez adresimize anlaşmalı olduğumuz kargo firmamız Yurtiçi Kargo aracılığıyla göndermeniz gerekmektedir.</p>
                    <p>2- Gönderdiğiniz kargo bize ulaştıktan sonra değişim siparişinizi oluşturmak için istediğiniz ürünlerin stokları tükenmeden iletişim sayfamızdaki bilgilerden iletişime geçmelisiniz.</p>
                    <p>3- İlgili ekibimiz gönderdiğiniz ürün ve verdiğiniz sipariş doğrultusunda değişim işleminizi gerçekleştirecektir.</p>
                    <p><strong>Değişim İşleminde Kargo Ücreti Ödeyecek miyim?</strong></p>
                    <p>1- Satın alınmış ürün ayıplı/defolu/yanlış şekilde tarafınıza ulaştıysa ayıplı/defolu/yanlış ürünü bizim adresimize gönderirken anlaşmalı olduğumuz kargo firmasını kullanırsanız kargo ücretini biz karşılıyoruz. Farklı bir kargo firması ile gönderim yapmanız durumunda kargo ücretini karşılamamaktayız.</p>
                    <p>2- Ayıplı/Defolu/Yanlış olmayan ürünlerin değişim işlemlerinde tarafımıza gönderirken kargo ücretini siz karşılıyorsunuz, ürün değişim işleminden sonra size gönderilen yeni ürününüzün kargo ücreti tarafınıza yansıtılmaktadır.</p>
                    <p>3- Değişimine karar verdiğiniz ürününüzü tarafımıza gönderirken kargo ücretleri sizin tarafınızdan karşılanmaktadır. Yeni ürününüzü size gönderirken Kargo Ücreti Tarafınıza Yansıtılacaktır.</p>
                    <p>4- İndirimli ürünlerde değişim ve iade KESİNLİKLE YOKTUR.</p>
                    <p><strong>Kapıda Ödeme Hakkında Önemli Bilgilendirme</strong></p>
                    <p>Aşağıdaki bildiri sitemiz üzerinden kapıda ödeme yöntemiyle sipariş verip kargosunu hiçbir şekilde teslim almayanlar içindir.</p>
                    <p>Kapıda ödeme ile satın alınmış ürünlerin kargodan teslim alınması zorunludur. Teslim alınmayan ürünler iade edilemez. Teslim alınmayıp iade gelen paketler, firma tarafından kargo maliyeti eklenerek müşteriye tekrar gönderilmek üzere bekletilir.</p>
                    <p>Aynı şekilde ürün teslim alınmazsa satış sözleşmesi, onay alınması için telefon görüşmesi kayıtları ve alıcının beyan ettiği adresi, sipariş esnasında kullanılan bilgisayar yer adresi (IP/ MAC Adresi) delil olarak kullanılarak; Kapıda ödeme ile alışveriş imkanını kötüye kullanma, tedarikçi, kargo ve paketleme görevlisini gereksiz kullanma ve iş gücünü yavaşlatma sebepleriyle; kargo masrafları, işletme masraflarının tamamının yasal yollarla tazmini için hukuki işlem başlatılır.</p>
                    <p>Alıcı kapıda ödemeli olarak satın aldığı ve teslim almayarak şirketi zarara uğrattığı her malın ve kargo dahil fatura tutarının en az kırk (40) en fazla doksan (90) katı kadar tazminat bedelini site sahiplerine peşinen ödemeyi resmen beyan eder.</p>
                    <p><strong>Değiştirdiğim Ürün Gönderdiğim Üründen Daha Pahalı</strong></p>
                    <p>1- Değişim siparişinizdeki ürünlerin toplam tutarı gönderdiğiniz ürün/ürünlerin tutarından yüksek ise kalan tutar KAPIDA ÖDEME olarak size yansıtılacaktır.</p>
                    <p>2- KAPIDA ÖDEMELİ KARGO ÜCRETİ HİZMET BEDELİ DAHİL 5,00 TÜRK LİRASIDIR. TUTAR FARKI OLAN TÜM KARGOLARA 5,00 LİRA KARGO ÜCRETİ YANSITILIR VE ALICI TARAFINDAN KARŞILANIR.</p>
                    <p><strong>İPTAL &amp; İADE</strong></p>
                    <p>Siparişim ayıplı/defolu/yanlış gönderilmiş Ne yapmalıyım?</p>
                    <p>Satışa sunduğumuz tüm ürünler, kargoya teslim edilmek üzere paketlenirken hasar kontrolünden geçer. Nadiren yaşanılan ürün ayıplı/defolu/yanlış şekilde tarafınıza ulaştıysa böyle bir durumda süreç şu şekilde işlemektedir;</p>
                    <p>Siparişiniz kargo görevlisi tarafından adresinize ulaştırıldığında, ürünü teslim almadan önce mutlaka dış pakette hasar kontrolü yapın ve herhangi bir hasar gördüğünüz anda “Durum Tespit Tutanağı” hazırlatın.</p>
                    <p>Sipariş tesliminden sonra fark ettiğiniz bir hasar durumunda, ilgili kargo şubesiyle hemen iletişim kurmanız ve “Durum Tespit Tutanağı” hazırlamalarını istemeniz gerekir. Eğer kargo şubesi size bu konuda yardımcı olmuyorsa, lütfen en kısa sürede bizi bilgilendirin.</p>
                    <p>Hasar Tespit Tutanağı ile birlikte hasarlı ürünü … adresimize gönderdiğinizde ürün değişim ya da iade işlemleriniz hızla tamamlanır ve size bu konuda bilgi verilir.</p>
                    <p><strong>Ürün İadesi yaptığımda ödediğim tutar bana nasıl iade edilecek?</strong></p>
                    <p>Ürün iadesi yaptığınız zaman, ürün incelemeden kabul onayı aldıktan sonra, ödeme şeklinize sadık kalınarak paranız iade yapılmaktadır.</p>
                    <p>– Ödemenizi kredi kartıyla gerçekleştirdiyseniz, taksitli işlemleriniz taksitli olarak, tek çekim işlemleriniz tek çekim olarak 7 iş günü içerisinde kartınıza iade edilir.</p>
                    <p>– Ödemenizi debit kart ile gerçekleştirdiyseniz, tek çekim olan işleminiz banka hesabınıza havale / eft yoluyla 7 iş günü içerisinde iade edilir.</p>
                    <p>– Ödemenizi sanal kart ile gerçekleştirdiyseniz, tek çekim işleminiz kartınıza 7 iş günü içerisinde iade edilir.</p>
                    <p>– Kapıda ödeme seçeneği ile ödeme yaptıysanız tarafımıza ileteceğiniz IBAN numarasına 7 iş günü içerisinde iade edilir.</p>
                    <p>Ürün İadesi Hesabıma Neden Geçmedi?</p>
                    <p>Vermiş olduğunuz IBAN dan kaynaklı bir sorun olabilir. Detaylı bilgi için iletişim sayfamız üzerinden iletişime geçebilirsiniz.</p>
                    <p>* DEĞİŞİM İŞLEMLERİNDE FATURA İBRAZI ZORUNLUDUR.</p>
                    <p>* DEĞİŞİM VE İADE İŞLEMLERİNDE ANLAŞMALI KARGO FİRMAMIZ SÜRAT KARGO İLE GÖNDERİM YAPMANIZ GEREKMEKTEDİR. DİĞER KARGO FİRMALARI İLE GÖNDERİLEN GÖNDERİLERİN KARGO ÜCRETLERİ FİRMAMIZ TARAFINDAN KARŞILANMAMAKTADIR.</p>
                    <ul>
                        <li>OUTLET GRUBUNA GİREN ÜRÜNLERDE DEĞİŞİM BULUNMAMAKTADIR.</li>
                    </ul>
                    <p>….’ nin internet yüzü olan {{ str_replace(['http://', 'https://'], '', url('/')) }}’den yapmış olduğunuz siparişlerde yukarıdaki şartlar yerine getirildiği halde değişim ve iade hakkınızı kullanabilirsiniz.</p>
                </article>
                <!-- #post-## -->
            </main>
            <!-- #main -->
        </div>
        <!-- #primary -->
    </div>
</div>

@elseif (Request::path() == 'satis-sozlesmesi')

<div class="container">
    <div class="row user-panel">
        <div id="primary" class="content-area col-xs-12">
            <main id="main" class="site-main" role="main">
                <article id="post-13" class="post-13 page type-page status-publish hentry">
                    <div class="row">
                        <div class="col-md-12">
                            <header>
                                <h1 class="page-title margin-top">Mesafeli Satış Sözleşmesi</h1>
                            </header>
                        </div>
                    </div>
                    <p><strong>Madde 1 – Sözleşmenin Tarafları</strong></p>
                    <p>SATICI: {{ $seo['author'] }} <br>Adres: {{ $iletisim['adres'] }} <br>Vergi Dairesi: GÜNEŞLİ<br>Vergi Numarası: 3250596478<br>Ticari Sicil: İstanbul Ticaret Odası 36658-5<br>Telefon: {{ $iletisim['tel'] }}<br>Email: info{{ '@'. str_replace(['http://', 'https://'], '', url('/')) }}</p>
                    <p>Bu internet sitesine girmeniz veya bu internet sitesindeki herhangi bir bilgiyi kullanmanız aşağıdaki koşulları kabul ettiğiniz anlamına gelir.</p>
                    <p>Bu internet sitesine girilmesi, sitenin ya da sitedeki bilgilerin ve diğer verilerin programların vs. kullanılması sebebiyle, sözleşmenin ihlali, haksız fiil, ya da başkaca sebeplere binaen, doğabilecek doğrudan ya da dolaylı hiçbir zarardan {{ $seo['author'] }}  sorumlu değildir. {{ $seo['author'] }} , sözleşmenin ihlali, haksız fiil, ihmal veya diğer sebepler neticesinde; işlemin kesintiye uğraması, hata, ihmal, kesinti hususunda herhangi bir sorumluluk kabul etmez.</p>
                    <p>{{ $seo['author'] }}  işbu site ve site uzantısında mevcut her tür hizmet, ürün, siteyi kullanma koşulları ile sitede sunulan bilgileri önceden bir ihtara gerek olmaksızın değiştirme, siteyi yeniden organize etme, yayını durdurma hakkını saklı tutar. Değişiklikler sitede yayım anında yürürlüğe girer. Sitenin kullanımı ya da siteye giriş ile bu değişiklikler de kabul edilmiş sayılır. Bu koşullar link verilen diğer web sayfaları için de geçerlidir.</p>
                    <p>{{ $seo['author'] }} , sözleşmenin ihlali, haksız fiil, ihmal veya diğer sebepler neticesinde; işlemin kesintiye uğraması, hata, ihmal, kesinti, silinme, kayıp, işlemin veya iletişimin gecikmesi, bilgisayar virüsü, iletişim hatası, hırsızlık, imha veya izinsiz olarak kayıtlara girilmesi, değiştirilmesi veya kullanılması hususunda herhangi bir sorumluluk kabul etmez.</p>
                    <p>Bu internet sitesi {{ $seo['author'] }} ’in kontrolü altında olmayan başka internet sitelerine bağlantı veya referans içerebilir. {{ $seo['author'] }} , bu sitelerin içerikleri veya içerdikleri diğer bağlantılardan sorumlu değildir.</p>
                    <p>{{ $seo['author'] }}  bu internet sitesinin genel görünüm ve dizaynı ile internet sitesindeki tüm bilgi, resim, {{ $seo['author'] }} markası ve diğer markalar, {{ str_replace(['http://', 'https://'], '', url('/')) }} alan adı, logo, ikon, demonstratif, yazılı, elektronik, grafik veya makinede okunabilir şekilde sunulan teknik veriler, bilgisayar yazılımları, uygulanan satış sistemi, iş metodu ve iş modeli de dahil tüm materyallerin (“Materyaller”) ve bunlara ilişkin fikri ve sınai mülkiyet haklarının sahibi veya lisans sahibidir ve yasal koruma altındadır. İnternet sitesinde bulunan hiçbir Materyal; önceden izin alınmadan ve kaynak gösterilmeden, kod ve yazılım da dahil olmak üzere, değiştirilemez, kopyalanamaz, çoğaltılamaz, başka bir lisana çevrilemez, yeniden yayımlanamaz, başka bir bilgisayara yüklenemez, postalanamaz, iletilemez, sunulamaz ya da dağıtılamaz. İnternet sitesinin bütünü veya bir kısmı başka bir internet sitesinde izinsiz olarak kullanılamaz. Aksine hareketler hukuki ve cezai sorumluluğu gerektirir. {{ $seo['author'] }} ’nin burada açıkça belirtilmeyen diğer tüm hakları saklıdır.</p>
                    <p>Müşterinin sisteme girdiği tüm bilgilere sadece Müşteri ulaşabilmekte ve bu bilgileri sadece Müşteri değiştirebilmektedir. Bir başkasının bu bilgilere ulaşması ve bunları değiştirmesi mümkün değildir. Ödeme sayfasında istenen kredi kartı bilgileriniz, siteden alışveriş yapan siz değerli müşterilerimizin güvenliğini en üst seviyede tutmak amacıyla hiçbir şekilde {{ str_replace(['http://', 'https://'], '', url('/')) }} veya ona hizmet veren şirketlerin sunucularında tutulmamaktadır. Bu şekilde ödemeye yönelik tüm işlemlerin {{ str_replace(['http://', 'https://'], '', url('/')) }} ara yüzü üzerinden banka ve bilgisayarınız arasında gerçekleşmesi sağlanmaktadır.</p>
                    <p>{{ $seo['author'] }} , dilediği zaman bu yasal uyarı sayfasının içeriğini güncelleme yetkisini saklı tutmaktadır ve kullanıcılarına siteye her girişte yasal uyarı sayfasını ziyaret etmelerini tavsiye etmektedir.</p>
                    <p><br>Adres: …<br>Vergi Dairesi: …<br>Vergi Numarası: …<br>Ticari Sicil: …<br>Telefon: …<br>Email: iletisim{{ '@'. str_replace(['http://', 'https://'], '', url('/')) }}</p>
                    <p>ALICI: Müşteri</p>
                    <p><strong>Madde 2 – Sözleşmenin Konusu</strong></p>
                    <p>İş bu sözleşmenin konusu, Alıcının Satıcıya ait {{ str_replace(['http://', 'https://'], '', url('/')) }} web sitesinden elektronik ortamda sipariş verdiği, sözleşmede bahsi geçen nitelikleri haiz ve yine sözleşmede satış fiyatı belirtilen mal/hizmetin satışı ve teslimi ile ilgili olarak 4077 sayılı Tüketicilerin Korunması Hakkındaki Kanun ve Mesafeli Sözleşmeler Uygulama Esas ve Usulleri Hakkında Yönetmelik hükümleri gereğince tarafların hak ve yükümlülüklerinin saptanmasıdır. Alıcı, satışa konu mal/hizmetlerin temel nitelikleri, satış fiyatı, ödeme şekli, teslimat koşulları vs. satışa konu mal/hizmet ile ilgili tüm ön bilgiler ve “cayma” hakkı konusunda bilgi sahibi olduğunu, bu ön bilgileri elektronik ortamda teyit ettiğini ve sonrasında mal/hizmeti sipariş verdiğini iş bu sözleşme hükümlerince kabul ve beyan eder. {{ str_replace(['http://', 'https://'], '', url('/')) }} sitesinde ödeme sayfasında yer alan ön bilgilendirme ve fatura iş bu sözleşmenin ayrılmaz parçalarıdır.</p>
                    <p><strong>Madde 3 – Sözleşme Tarihi</strong></p>
                    <p>Satıcı tarafından daha önce imzalanmış bulunan iş bu iki nüsha sözleşme alıcı tarafından ……….. tarihinde imzalanarak kabul edilmiş ve bir nüshası alıcının mail adresine mail gönderilecektir.</p>
                    <p><strong>Madde 4 – Mal veya Hizmetin Teslimi, Sözleşmenin İfa Yeri ve Teslim Şekli</strong></p>
                    <p>Mal/hizmet, alıcının teslimini talep etmiş olduğu ………… adresinde …………….`a teslim edilecektir.</p>
                    <p><strong>Madde 5 – Teslimat Masrafları ve İfası</strong></p>
                    <p>Teslimat masrafları alıcıya aittir. Satıcı, web sitesinde, ilan ettiği rakamın üzerinde alışveriş yapanların teslimat ücretinin kendisince karşılanacağını yada kampanya dahilinde ücretsiz teslimat yapacağını beyan etmişse, teslimat masrafı satıcıya aittir. Teslimat; stokun müsait olması ve mal bedelinin satıcının hesabına geçmesinden sonra en kısa sürede yapılır. Satıcı, mal/hizmetin siparişinden itibaren 30 (Otuz) gün içinde teslim eder ve bu süre içinde yazılı bildirimle ek 10 (on) günlük süre uzatım hakkını saklı tutar. Herhangi bir nedenle mal/hizmet bedeli ödenmez veya banka kayıtlarında iptal edilir ise, satıcı mal/hizmetin teslimi yükümlülüğünden kurtulmuş kabul edilir.</p>
                    <p><strong>Madde 6 – Kapıda Ödeme Ücreti</strong></p>
                    <p>Kapıda ödeme servisi kargo şirketi tarafından sağlanan bir ödeme seçeneğidir. Bu servis için kargo şirketi … TL tahsil etmektedir. Bu servis bedeli kargo şirketine ait olup, ürün iadesi halinde iade edilemez. Ürününüzü alırken ekstra bir ücret ödemek istemiyorsanız Kredi kartı ile güvenli ödeme seçeneğini seçerek ödemelerinizi güvenli bir şekilde hiçbir ekstra servis ücreti ödemeden yapabilirsiniz.</p>
                    <p><strong>Madde 7 – Alıcının Beyan ve Taahhütleri</strong></p>
                    <p>Alıcı, sözleşme konusu mal/hizmeti teslim almadan önce muayene edecek; ezik, kırık, ambalajı yırtılmış vb. hasarlı ve ayıplı mal/hizmeti kargo şirketinden teslim almayacaktır. Teslim alınan mal/hizmetin hasarsız ve sağlam olduğu kabul edilecektir. Teslimden sonra mal/hizmetin özenle korunması borcu, alıcıya aittir. Cayma hakkı kullanılacaksa mal/hizmet kullanılmamalıdır. Fatura iade edilmelidir. Mal/hizmetin tesliminden sonra alıcıya ait kredi kartının alıcının kusurundan kaynaklanmayan bir şekilde yetkisiz kişilerce haksız veya hukuka aykırı olarak kullanılması nedeni ile ilgili banka veya finans kuruluşunun mal/hizmet bedelini satıcıya ödememesi halinde, Alıcı kendisine teslim edilmiş olması kaydıyla mal/hizmeti 3 (Üç) gün içinde satıcıya göndermekle yükümlüdür. Bu takdirde teslimat giderleri alıcıya aittir.</p>
                    <p><strong>Madde 8 – Satıcının Beyan ve Taahhütleri</strong></p>
                    <p>Satıcı, sözleşme konusu mal/hizmetin sağlam, eksiksiz, siparişte belirtilen niteliklere uygun ve varsa garanti belgeleri ve kullanım kılavuzları ile teslim edilmesinden sorumludur. Sözleşme konusu mal/hizmet, alıcıdan başka bir kişi/kuruluşa teslim edilecek ise, teslim edilecek kişi/kuruluşun teslimatı kabul etmemesinden satıcı sorumlu tutulamaz. Satıcı, cayma beyanının kendisine ulaşmasından sonra 10 (on) gün içinde mal/hizmet bedelini, varsa kıymetli evrakı iade eder. Mal/hizmeti 20 (yirmi) gün içinde iade alir. Haklı gerekçelerle satıcı, sözleşmedeki ifa süresi dolmadan alıcıya eşit kalite ve fiyatta tedarik edebilir. Satıcı mal/hizmetin ifasının imkânsızlaştığını düşünüyorsa, sözleşmenin ifa süresi dolmadan alıcıya bildirir. Ödenen bedel ve varsa belgeler</p>
                    <p>10 (on) gün içinde iade edilir. Garanti belgesi ile satılan mal/hizmetlerden olan veya olmayan mal/hizmetlerden arızalı veya bozuk olan mal/hizmetler, garanti şartları içinde gerekli onarımın yapılması için satıcıya gönderilebilir, bu takdirde teslimat giderleri satıcı tarafından karşılanacaktır.</p>
                    <p><strong>Madde 9 – Sözleşmeye Konu Olan Mal veya Hizmetin Özellikleri</strong></p>
                    <p>Mal/hizmetin cinsi ve türü, miktarı, marka/modeli, rengi ve tüm vergiler dâhil satış bedeli {{ str_replace(['http://', 'https://'], '', url('/')) }} adlı web sitesindeki mal/hizmet tanıtım sayfasında yer alan bilgilerde ve iş bu sözleşmenin ayrılmaz parçası sayılan faturada belirtildiği gibidir.</p>
                    <p><strong>Madde 10 – Mal veya Hizmetin Peşin Fiyatı</strong></p>
                    <p>Mal/hizmetin peşin fiyatı sipariş sonu mail atılan örnek fatura ve ürün ile birlikte müşteriye gönderilen fatura içeriğinde mevcuttur.</p>
                    <p><strong>Madde 11 – Vadeli Fiyat</strong></p>
                    <p>Mal/hizmetin satış fiyatına yapılan vadeye göre fiyatı sipariş sonu mail atılan örnek fatura ve ürün ile birlikte müşteriye gönderilen fatura içeriğinde mevcuttur.</p>
                    <p><strong>Madde 12 – Faiz</strong></p>
                    <p>Her yıl Türkiye Cumhuriyeti Hukümetinin belirlediği faiz oranından ve her halde %30`dan fazla olamaz. Alıcı çalıştığı bankaya karşı sorumludur.</p>
                    <p><strong>Madde 13 – Peşinat Tutarı</strong></p>
                    <p>Mal/hizmetin peşinat tutarı sipariş sonu mail atılan örnek fatura ve ürün ile birlikte müşteriye gönderilen fatura içeriğinde mevcuttur.</p>
                    <p><strong>Madde 14 – Ödeme Planı</strong></p>
                    <p>Alıcının, kredi kartı ile ve taksitle alışveriş yapması durumunda siteden seçmiş olduğu taksit biçimi geçerlidir.</p>
                    <p>Taksitlendirme işlemlerinde, alıcı ile kart sahibi banka arasında imzalamış bulunan sözleşmenin ilgili hükümleri geçerlidir. Kredi kartı ödeme tarihi banka ile alıcı arasındaki sözleşme hükümlerince belirlenir. Alıcı, ayrıca bankanın gönderdiği hesap özetinden taksit sayısını ve ödemelerini takip edebilir.</p>
                    <p><strong>Madde 15 – Cayma Hakkı</strong></p>
                    <p>Alıcı, sözleşme konusu mal/hizmetin kendisine veya gösterdiği adresteki kişi/kuruluşa tesliminden itibaren 7 (yedi) gün içinde cayma hakkını kullanabilir. Cayma hakkının kullanılması için aynı süre içinde satıcının müşteri hizmetlerine e-posta veya telefon ile bildirimde bulunulması ve mal/hizmetin 15. Madde hükümleri çerçevesinde ve iş bu sözleşmenin ayrılmaz parçası olan ve {{ str_replace(['http://', 'https://'], '', url('/')) }} web sitesinde yayınlanmış olan ön bilgiler gereğince, kullanılmamış olması şarttır. Bu hakkın kullanılması halinde, 3. kişiye veya alıcıya teslim edilen mal/hizmete ilişkin fatura aslının iadesi zorunludur. Cayma hakkına ilişkin ihbarın ulaşmasını takip eden 7 gün içinde mal/hizmet bedeli alıcıya iade edilir ve 20 (yirmi) günlük süre içinde mal/hizmet iade alınır. Fatura aslı gönderilmezse alıcıya KDV ve varsa diğer yasal yükümlülükler iade edilemez. Cayma hakkı nedeni ile iade edilen mal/hizmetin teslimat bedeli satıcı tarafından karşılanır.</p>
                    <p><strong>Madde 16 – Cayma Hakkı Kullanılamayacak Mal ve Hizmetler</strong></p>
                    <p>Niteliği itibarıyla iade edilemeyecek mal/hizmetler, hızla bozulan ve son kullanma tarihi geçen mal/hizmetler, tek kullanımlık mal/hizmetler, hijyenik mal/hizmetler, abiye mal/hizmetler, opyalanabilir her türlü yazılım ve programlardır. Ayrıca, her türlü yazılım ve programlarında, Çeşitli medyaların (Dvd,Cd v.b), bilgisayar ve kırtasiye sarf malzemelerinde (toner, kartuş, şerit v.b) ile kozmetik malzemelerinde cayma hakkının kullanılabilmesi için mal/hizmetin ambalajının açılmamış, bozulmamış ve kullanılmamış olmaları şartı bulunmaktadır.</p>
                    <p><strong>Madde 17 – Temerrüd Hali ve Hukuki Sonuçları</strong></p>
                    <p>Alıcı, kredi kartı ile yapmış olduğu işlemlerinde temerrüde düşmesi halinde kart sahibi bankanın kendisi ile yapmış olduğu kredi kartı sözleşmesi çerçevesinde faiz ödeyecek ve bankaya karşı sorumlu olacaktır. Bu durumda ilgili banka hukuki yollara başvurabilir; doğacak masrafları ve vekalet ücretini alıcıdan talep edebilir ve her koşulda alıcının borcundan dolayı temerrüde düşmesi halinde, alıcı, borcun gecikmeli ifasından dolayı satıcının oluşan zarar ve ziyanını ödemeyi kabul eder.</p>
                    <p><strong>Madde 18 – Yetkili Mahkeme</strong></p>
                    <p>İş bu sözleşmeden kaynaklanabilecek ihtilaflarda, Sanayi ve Ticaret Bakanlığınca ilan edilen değere kadar Tüketici Hakem Heyetleri, belirtilen değer üstüne Tüketici Mahkemeleri; bulunamayan yerlerde Asliye Hukuk Mahkemeleri yetkilidir.</p>
                </article>
                <!-- #post-## -->
            </main>
            <!-- #main -->
        </div>
        <!-- #primary -->
    </div>
</div>

@elseif (Request::path() == 'uyelik-sozlesmesi')

<div class="container">
    <div class="row user-panel">
        <div id="primary" class="content-area col-xs-12">
            <main id="main" class="site-main" role="main">
                <article id="post-8" class="post-8 page type-page status-publish hentry">
                    <div class="row">
                        <div class="col-md-12">
                            <header>
                                <h1 class="page-title margin-top">Üyelik Sözleşmesi</h1>
                            </header>
                        </div>
                    </div>
                    <p>Lütfen sitemizi kullanmadan evvel bu ‘site kullanım şartları’nı dikkatlice okuyunuz.</p>
                    <p>Bu alışveriş sitesini kullanan ve alışveriş yapan müşterilerimiz aşağıdaki şartları kabul etmiş varsayılmaktadır:</p>
                    <p>Sitemizdeki web sayfaları ve ona bağlı tüm sayfalar (‘site’) ……………………… adresindeki ……………………………….firmasına (‘Firma) aittir ve onun tarafından işletilir. Sizler (‘Kullanıcı’) sitede sunulan tüm hizmetleri kullanırken aşağıdaki şartlara tabi olduğunuzu, sitedeki hizmetten yararlanmakla ve kullanmaya devam etmekle; Bağlı olduğunuz yasalara göre sözleşme imzalama hakkına, yetkisine ve hukuki ehliyetine sahip ve 18 yaşın üzerinde olduğunuzu, bu sözleşmeyi okuduğunuzu, anladığınızı ve sözleşmede yazan şartlarla bağlı olduğunuzu kabul etmiş sayılırsınız.</p>
                    <p>İşbu sözleşme süresiz olmakla, taraflara sözleşme konusu site ile ilgili hak ve yükümlülükler yükler ve taraflar işbu sözleşmeyi online veya yazık olarak kabul ettiklerinde/onayladıklarında bahsi geçen hak ve yükümlülükleri eksiksiz, doğru, zamanında, işbu sözleşmede talep edilen şartlar dâhilinde yerine getireceklerini beyan ve taahhüt ederler.</p>
                    <p>1. SORUMLULUKLAR</p>
                    <p>Firma, fiyatlar ve sunulan ürün ve hizmetler üzerinde değişiklik yapma hakkını her zaman saklı tutar.</p>
                    <p>Firma, üyenin sözleşme konusu hizmetlerden, teknik arızalar dışında yararlandırılacağını kabul ve taahhüt eder.</p>
                    <p>Kullanıcı, sitenin kullanımında tersine mühendislik yapmayacağını ya da bunların kaynak kodunu bulmak veya elde etmek amacına yönelik herhangi bir başka işlemde bulunmayacağını aksi halde ve 3. Kişiler nezdinde doğacak zararlardan sorumlu olacağını, hakkında hukuki ve cezai işlem yapılacağını peşinen kabul eder.</p>
                    <p>Kullanıcı, siteye üye olurken vermiş olduğu eksik ve yanlış bilgi dolayısıyla uğrayacağı zararlardan sadece kendisinin sorumlu olacağını, yanlış bilgi vermesi durumunda ve işbu sözleşmenin Üye tarafından ihlali halinde, firmanın tek taraflı olarak herhangi bir ihbara ve ihtara ihtiyaç duymaksızın üyeliğini sona erebileceğini kabul eder.</p>
                    <p>Firma tarafından internet sitesinin iyileştirilmesi, geliştirilmesine yönelik olarak ve/veya yasal mevzuat çerçevesinde siteye erişmek için kullanılan Internet servis sağlayıcısının adı ve Internet Protokol (IP) adresi, Siteye erişilen tarih ve saat, sitede bulunulan sırada erişilen sayfalar ve siteye doğrudan bağlanılmasını sağlayan Web sitesinin Internet adresi gibi birtakım bilgiler toplanabilir. Kullanıcı, bu bilgilerin toplanmasını kabul eder.</p>
                    <p>Kullanıcı, site içindeki faaliyetlerinde, sitenin herhangi bir bölümünde veya iletişimlerinde genel ahlaka ve adaba aykırı, kanuna aykırı, 3. Kişilerin haklarını zedeleyen, yanıltıcı, saldırgan, müstehcen, pornografik, kişilik haklarını zedeleyen, telif haklarına aykırı, yasa dışı faaliyetleri teşvik eden içerikler üretmeyeceğini, paylaşmayacağını kabul eder. Aksi halde oluşacak zarardan tamamen kendisi sorumludur ve bu durumda ‘Site’ yetkilileri, bu tür hesapları askıya alabilir, sona erdirebilir, yasal süreç başlatma hakkını saklı tutar. Bu sebeple yargı mercilerinden etkinlik veya kullanıcı hesapları ile ilgili bilgi talepleri gelirse, mercilerle bu bilgileri paylaşma hakkını saklı tutar.</p>
                    <p>Sitenin üyelerinin birbirleri veya üçüncü şahıslarla olan ilişkileri kendi sorumluluğundadır.</p>
                    <p>2. FİKRİ MÜLKİYET HAKLARI</p>
                    <p>2.1. İşbu Site’de yer alan ünvan, işletme adı, marka, patent, logo, tasarım, bilgi ve yöntem gibi tescilli veya tescilsiz tüm fikri mülkiyet hakları site işleteni ve sahibi firmaya veya belirtilen ilgilisine ait olup, ulusal ve uluslararası hukukun koruması altındadır. İşbu Site’nin ziyaret edilmesi veya bu Site’deki hizmetlerden yararlanılması söz konusu fikri mülkiyet hakları konusunda hiçbir hak vermez.</p>
                    <p>2.2. Site’de yer alan bilgiler hiçbir şekilde çoğaltılamaz, yayınlanamaz, kopyalanamaz, sunulamaz ve/veya aktarılamaz. Site’nin bütünü veya bir kısmı diğer bir internet sitesinde izinsiz olarak kullanılamaz. Böyle bir ihlal durumunda, kullanıcı,üçüncü kişilerin uğradıkları zararlardan dolayı firmadan talep edilen tazminat miktarını ve mahkeme masrafları ve avukatlık ücreti de dahil ancak bununla sınırlı olmamak üzere diğer her türlü yükümlülükleri karşılamakla sorumlu olacaklardır.</p>
                    <p>3. GİZLİ BİLGİ</p>
                    <p>3.1. Firma, site üzerinden kullanıcıların ilettiği kişisel bilgileri 3. Kişilere açıklamayacaktır. Bu kişisel bilgiler; kişi adı-soyadı, adresi, telefon numarası, cep telefonu, e-posta adresi gibi Kullanıcı’yı tanımlamaya yönelik her türlü diğer bilgiyi içermekte olup, kısaca ‘Gizli Bilgiler’ olarak anılacaktır.</p>
                    <p>3.2. Kullanıcı, tanıtım, reklam, kampanya, promosyon, duyuru vb. pazarlama faaliyetleri kapsamında kullanılması ile sınırlı olmak üzere, Site’nin sahibi olan firmanın kendisine ait iletişim, portföy durumu ve demografik bilgilerini iştirakleri ya da bağlı bulunduğu grup şirketleri ile paylaşmasına, kendisi veya iştiraklerine yönelik bu bağlamda elektronik ileti almaya onay verdiğini kabul ve beyan eder. Bu kişisel bilgilerfirma bünyesindemüşteri profili belirlemek, müşteri profiline uygun promosyon ve kampanyalar sunmak ve istatistiksel çalışmalar yapmak amacıyla kullanılabilecektir.</p>
                    <p>3.3.Kullanıcı, işbu sözleşme ile vermiş olduğu onayı, hiçbir gerekçe açıklamaksızın iptal etmek hakkını sahiptir. İptal işlemini firma, derhal işleme alıp, 3 (üç) işgünü içerisinde kullanıcıyı elektronik ileti almaktan imtina eder.</p>
                    <p>3.4.Gizli Bilgiler, ancak resmi makamlarca usulü dairesinde bu bilgilerin talep edilmesi halinde ve yürürlükteki emredici mevzuat hükümleri gereğince resmi makamlara açıklama yapılmasının zorunlu olduğu durumlarda resmi makamlara açıklanabilecektir.</p>
                    <p>4. GARANTİ VERMEME:</p>
                    <p>İŞBU SÖZLEŞME MADDESİ UYGULANABİLİR KANUNUN İZİN VERDİĞİ AZAMİ ÖLÇÜDE GEÇERLİ OLACAKTIR. FİRMA TARAFINDAN SUNULAN HİZMETLER “OLDUĞU GİBİ” VE “MÜMKÜN OLDUĞU” TEMELDE SUNULMAKTA VE PAZARLANABİLİRLİK, BELİRLİ BİR AMACA UYGUNLUK VEYA İHLAL ETMEME KONUSUNDA TÜM ZIMNİ GARANTİLER DE DÂHİL OLMAK ÜZERE HİZMETLER VEYA UYGULAMA İLE İLGİLİ OLARAK (BUNLARDA YER ALAN TÜM BİLGİLER DÂHİL) SARİH VEYA ZIMNİ, KANUNİ VEYA BAŞKA BİR NİTELİKTE HİÇBİR GARANTİDE BULUNMAMAKTADIR.</p>
                    <p>5. KAYIT VE GÜVENLİK</p>
                    <p>Kullanıcı, doğru, eksiksiz ve güncel kayıt bilgilerini vermek zorundadır. Aksi halde bu Sözleşme ihlal edilmiş sayılacak ve Kullanıcı bilgilendirilmeksizin hesap kapatılabilecektir.</p>
                    <p>Kullanıcı, site ve üçüncü taraf sitelerdeki şifre ve hesap güvenliğinden kendisi sorumludur. Aksi halde oluşacak veri kayıplarından ve güvenlik ihlallerinden veya donanım ve cihazların zarar görmesinden Firma sorumlu tutulamaz.</p>
                    <p>6. MÜCBİR SEBEP</p>
                    <p>Tarafların kontrolünde olmayan; tabii afetler, yangın, patlamalar, iç savaşlar, savaşlar, ayaklanmalar, halk hareketleri, seferberlik ilanı, grev, lokavt ve salgın hastalıklar, altyapı ve internet arızaları, elektrik kesintisi gibi sebeplerden (aşağıda birlikte “Mücbir Sebep” olarak anılacaktır.) dolayı sözleşmeden doğan yükümlülükler taraflarca ifa edilemez hale gelirse, taraflar bundan sorumlu değildir. Bu sürede Taraflar’ın işbu Sözleşme’den doğan hak ve yükümlülükleri askıya alınır.</p>
                    <p>7. SÖZLEŞMENİN BÜTÜNLÜĞÜ VE UYGULANABİLİRLİK</p>
                    <p>İşbu sözleşme şartlarından biri, kısmen veya tamamen geçersiz hale gelirse, sözleşmenin geri kalanı geçerliliğini korumaya devam eder.</p>
                    <p>8. SÖZLEŞMEDE YAPILACAK DEĞİŞİKLİKLER</p>
                    <p>Firma, dilediği zaman sitede sunulan hizmetleri ve işbu sözleşme şartlarını kısmen veya tamamen değiştirebilir. Değişiklikler sitede yayınlandığı tarihten itibaren geçerli olacaktır. Değişiklikleri takip etmek Kullanıcı’nın sorumluluğundadır. Kullanıcı, sunulan hizmetlerden yararlanmaya devam etmekle bu değişiklikleri de kabul etmiş sayılır.</p>
                    <p>9. TEBLİGAT</p>
                    <p>İşbu Sözleşme ile ilgili taraflara gönderilecek olan tüm bildirimler, Firma’nınbilinen e.posta adresi ve kullanıcının üyelik formunda belirttiği e.posta adresi vasıtasıyla yapılacaktır. Kullanıcı, üye olurken belirttiği adresin geçerli tebligat adresi olduğunu, değişmesi durumunda 5 gün içinde yazılı olarak diğer tarafa bildireceğini, aksi halde bu adrese yapılacak tebligatların geçerli sayılacağını kabul eder.</p>
                    <p>10. DELİL SÖZLEŞMESİ</p>
                    <p>Taraflar arasında işbu sözleşme ile ilgili işlemler için çıkabilecek her türlü uyuşmazlıklarda Taraflar’ın defter, kayıt ve belgeleri ile ve bilgisayar kayıtları ve faks kayıtları 6100 sayılı Hukuk Muhakemeleri Kanunu uyarınca delil olarak kabul edilecek olup, kullanıcı bu kayıtlara itiraz etmeyeceğini kabul eder.</p>
                    <p>11. UYUŞMAZLIKLARIN ÇÖZÜMÜ</p>
                    <p>İşbu Sözleşme’nin uygulanmasından veya yorumlanmasından doğacak her türlü uyuşmazlığın çözümünde İstanbul (Merkez) Adliyesi Mahkemeleri ve İcra Daireleri yetkilidir.</p>
                </article>
                <!-- #post-## -->
            </main>
            <!-- #main -->
        </div>
        <!-- #primary -->
    </div>
</div>

@elseif (Request::path() == 'on-bilgilendirme-formu')

<div class="container">
    <div class="row user-panel">
        <div id="primary" class="content-area col-xs-12">
            <main id="main" class="site-main" role="main">
                <article id="post-10" class="post-10 page type-page status-publish hentry">
                    <div class="row">
                        <div class="col-md-12">
                            <header>
                                <h1 class="page-title margin-top">Ön Bilgilendirme Formu</h1>
                            </header>
                        </div>
                    </div>
                    <p>SATICI</p>
                    <p>ÜNVANI : {{ $seo['author'] }} <br>ADRES : {{ $iletisim['adres'] }} <br>TELEFON : {{ $iletisim['tel'] }}<br>WEB : {{ str_replace(['http://', 'https://'], '', url('/')) }}<br>E-POSTA : info{{ '@'. str_replace(['http://', 'https://'], '', url('/')) }}</p>
                    <p>Bundan sonra SATICI olarak anılacaktır.</p>
                    <p>ALICI</p>
                    <p>ADI SOYADI / ÜNVANI : ……<br>ADRES : ……<br>TELEFON : ……<br>E-POSTA : ……</p>
                    <p>Bundan sonra ALICI olarak anılacaktır.</p>
                    <p>1-) MAL / HİZMETİN ADI, MİKTARI VE KDV DAHİL SATIŞ FİYATI</p>
                    <p>{_Siparis_Urun_Listesi_}</p>
                    <p>2-) MAL / HİZMETİN TÜM VERGİLER DAHİL TESLİM FİYATI</p>
                    <p>Kargo Ücreti : {_Siparis_Kargo_Ucreti_}</p>
                    <p>Kdv Dahil Teslim Fiyatı : {_Siparis_Toplam_Tutari_}</p>
                    <p>3-) ÖDEME ŞEKLİ</p>
                    <p>{_Siparis_Odeme_Sekli_}</p>
                    <p>4-) GEÇERLİLİK SÜRESİ</p>
                    <p>Listelenen ve siteden ilan edilen fiyatlar satış fiyatıdır. İlan edilen fiyatlar ve vaatler güncelleme yapılana ve değiştirilene kadar geçerlidir. Süreli olarak ilan edilen fiyatlar ise belirtilen süre sonuna kadar geçerlidir. Ancak hatayla yanlış yazılan, tedarikçinin geç bildirmesi ile güncellenmemiş olan fiyat farklılıklarında, SATICI’nın ALICI’ya bildireceği güncel fiyat geçerlidir. Hata durumlarında mal/hizmet bedelinden fazla çekim yapılmışsa farkı iade edilir. Mal/hizmetin gerçek fiyatı ilan edilenden farklı ise ALICI’ya gerçek fiyat bildirilir. ALICI’nın talebi doğrultusunda gerçek fiyat üzerinden satış gerçekleştirilir ya da satış iptal edilir.</p>
                    <p>5-) MAL / HİZMETİN TESLİMATI</p>
                    <p>Mal/hizmetin teslimi ALICI’nın talep ettiği adreste kendisine yapılır. ALICI, kendisinden başka birine ve de kendi adresinden başka bir adrese teslimat yapılmasını isterse, bu talebi doğrultusunda teslimat yapılır. Teslimat masrafları ALICI’ya aittir. SATICI, web sitesinde, ilan ettiği rakamın üzerinde alışveriş yapanların teslimat ücretinin kendisince karşılanacağını beyan etmişse, teslimat masrafı SATICI’ya aittir. Mal/hizmet teslimatı kargo firmalarınca yapılmaktadır. Tüketici teslim almadan önce malın muayenesini yapmalı, ayıplı ve hasarlı malı kargo firması yetkilisinden teslim almamalıdır. ALICI kargodan teslim alınan ürünün sağlam ve hasarsız olduğunu kabul eder. ALICI’nın teslim öncesi malı muayene sorumluluğu vardır. Sipariş konusu mal/hizmetin teslimatı için mesafeli satış sözleşmesinin imzalı bir nüshasının SATICI’ya ulaştırılmış olması ve bedelinin ALICI’nın tercih ettiği ödeme sekli ile ödenmiş olması şarttır. Herhangi bir nedenle mal/hizmet bedeli ödenmez veya banka kayıtlarında iptal edilir ise, SATICI mal/hizmetin teslimi yükümlülüğünden kurtulmuş kabul edilir.</p>
                    <p>6-) CAYMA HAKKI</p>
                    <p>ALICI, sözleşme konusu mal/hizmetin kendisine veya gösterdiği adresteki kişi/kuruluşa tesliminden itibaren 7 (yedi) gün içinde cayma hakkını kullanabilir. Cayma hakkının kullanılması için aynı süre içinde SATICI’ya faks, e-posta (iletisim{{ '@'. str_replace(['http://', 'https://'], '', url('/')) }}) veya …. nolu telefon ile bildirimde bulunulması ve mal/hizmetin 7. madde hükümleri çerçevesinde ve iş bu sözleşmenin ayrılmaz parçası olan ve {{ str_replace(['http://', 'https://'], '', url('/')) }} web sitesinde yayınlanmış olan önbilgiler gereğince, ambalaj ve içeriğinin denenirken hasar görmemiş olası şarttır. Bu hakkın kullanılması halinde, 3. kişiye veya ALICI’ya teslim edilen mal/hizmete ilişkin fatura aslının iadesi zorunludur. Cayma hakkına ilişkin ihbarın ulaşmasını takip eden 10 (on) gün içinde mal/hizmet bedeli ALICI’ya iade edilir ve 20 (yirmi) günlük süre içinde mal/hizmet iade alınır. Fatura aslı gönderilmezse, ALICI’ya KDV ve varsa diğer yasal yükümlülükler iade edilemez. Cayma hakkı nedeni ile iade edilen mal/hizmetin teslimat bedeli SATICI tarafından karşılanır.</p>
                    <p>7-) CAYMA HAKKI KULLANILAMAYACAK MAL/HİZMETLER</p>
                    <p>Niteliği itibarıyla iade edilemeyecek mal/hizmetler, hızla bozulan ve son kullanma tarihi geçen mal/hizmetler, tek kullanımlık mal/hizmetler, kopyalanabilir her türlü yazılım ve programlardır. Ayrıca, her türlü yazılım ve programların da, DVD, DIVX, VCD, CD, MD, videokasetlerde, bilgisayar ve kırtasiye sarf malzemelerinde (toner, kartuş, şerit v.b) ile kozmetik malzemelerinde cayma hakkının kullanılabilmesi için mal/hizmetin ambalajının açılmamış, bozulmamış ve kullanılmamış olmaları şartı bulunmaktadır.</p>
                    <p>DİKKAT: Alıcının istekleri ve/veya açıkça onun kişisel ihtiyaçları doğrultusunda hazırlanan mallar için cayma hakkı söz konusu değildir.</p>
                    <p>8-) MAL / HİZMETİN TESLİM ZAMANI</p>
                    <p>Teslimat; stoğun müsait olması ve mal bedelinin SATICI’nın hesabına geçmesinden sonra mümkün olan en kısa sürede yapılır. Doğal afetler, hava muhalefeti vs. gibi mücbir sebeplerle gecikmeler olabilir. SATICI, mal/hizmetin siparişinden itibaren 30 (Otuz) gün içinde teslim işlemini gerçekleştirir. Ayrıca SATICI, bu süre içinde yazılı bildirimle ek 10 (On) günlük süre uzatım hakkını saklı tutar.</p>
                    <p>9-) TALEP VE ŞİKAYETLERİN İLETİLMESİ</p>
                    <p>ALICI, her türlü talep ve şikâyetlerini SATICI’nın yukarıda belirtilen iletişim adreslerine yapabilir. ALICI, 4822 S.K. ile değişik 4077 S.K.’un M. 9/A, f.2 ve Mes. Söz. Yön. 5. ve 6. maddeleri gereğince Ön Bilgileri okuyup bilgi sahibi olduğunu ve elektronik ortamda gerekli teyidi verdiğini kabul, taahhüt ve beyan eder.</p>
                </article>
                <!-- #post-## -->
            </main>
            <!-- #main -->
        </div>
        <!-- #primary -->
    </div>
</div>

@elseif (Request::path() == 'teslimat-kargo')

<div class="container">
    <div class="row user-panel">
        <div id="primary" class="content-area col-xs-12">
            <main id="main" class="site-main" role="main">
                <article id="post-24" class="post-24 page type-page status-publish hentry">
                    <div class="row">
                        <div class="col-md-12">
                            <header>
                                <h1 class="page-title margin-top">Kargo ve Teslimat Politikası</h1>
                            </header>
                        </div>
                    </div>
                    <p><strong>Kargo ücreti ne kadar?</strong></p>
                    <p>{{ str_replace(['http://', 'https://'], '', url('/')) }} adresinde tüm alışverişlerinizde kargo ÜCRETSİZDİR.</p>
                    <p><strong>Siparişim hangi kargo şirketi ile gönderilecek?</strong></p>
                    <p>Siparişleriniz Sürat Kargo ile gönderilecektir.</p>
                    <p><strong>Siparişimi ne zaman teslim alabilirim?</strong></p>
                    <p>Siparişleriniz 1 işgünü içinde kargoya teslim edilir.Kargo bilgiler bölümümüzden kargonuzu takip edebilirsiniz.</p>
                    <p><strong>Siparişimi nasıl takip edebilirim?</strong></p>
                    <p>Üst menüde "Sipariş Takibi" alanını seçtiğinizde açılan sayfada siparişlerinizin durumunu takip edebilirsiniz. Siparişiniz kargoya teslim edildiğinde size ayrıca bir bilgi e-postası gönderilecektir.</p>
                    <p><strong>Siparişim ben yokken gelirse ne yapmalıyım?</strong></p>
                    <p>Belirtilen adreste olmamanız durumunda siparişiniz en yakın sürat kargo şubesine teslim edilir ve size bilgi notu bırakılır. 3 gün içerisinde paketinizi belirtilen şubeden almanız gerekmektedir. Aksi taktirde siparişiniz firmaya iade edilir ve kargo ücreti tarafınıza fatura edilir. İade edilen siparişinizin tekrar gönderilmesini isterseniz kargo bedeli yeniden talep edilecek, siparişiniz karşı ödemeli olarak adınıza tekrar sevk edilecektir.</p>
                    <p><strong>Ürünü teslim alırken nelere dikkat etmeliyim?</strong></p>
                    <p>Siparişinizi teslim aldığınızda kargo paketinde yırtılma, ezilme, ıslanma vb. bir sorun olup olmadığını mutlaka kargo görevlisinin yanında kontrol etmelisiniz. Kargo yetkilisi, kargo paketinde veya içeriğinde bir problem olması durumunda size yardımcı olacaktır. Böyle bir durumda kargoyu teslim almamanız ve kargo yetkilisine tutanak tutturmanız gerekmektedir. Tutanak, ürün değişimi ve iade sürecinde işlemlerinde işinizi kolaylaştıracaktır.</p>
                </article>
                <!-- #post-## -->
            </main>
            <!-- #main -->
        </div>
        <!-- #primary -->
    </div>
</div>

@elseif (Request::path() == 'kvkk-beyani')

<div class="container">
    <div class="row user-panel">
        <div id="primary" class="content-area col-xs-12">
            <main id="main" class="site-main" role="main">
                <article id="post-16" class="post-16 page type-page status-publish hentry">
                    <div class="row">
                        <div class="col-md-12">
                            <header>
                                <h1 class="page-title margin-top">Kişisel Verilerin Korunması Politikası</h1>
                            </header>
                        </div>
                    </div>
                    <p><strong>Kişisel Veriler Kanunu hakkında genel bilgilendirme</strong></p>
                    <p>6698 Sayılı Kişisel Verilerin Korunması Kanunu (bundan sonra KVKK olarak anılacaktır) 24 Mart 2016 tarihinde kabul edilmiş, 7 Nisan 2016 tarihli 29677 sayılı Resmi Gazete’de yayınlanmıştır. KVKK’nun bir kısmı yayın tarihinde, bir kısmı ise 7 Ekim 2016’da yürürlüğe girmiştir.</p>
                    <p><strong>Veri sorumlusu sıfatıyla bilgilendirme</strong></p>
                    <p>6698 sayılı KVKK uyarınca ve Veri Sorumlusu sıfatıyla, kişisel verileriniz bu sayfada açıklandığı çerçevede; kaydedilecek, saklanacak, güncellenecek, mevzuatın izin verdiği durumlarda 3. kişilere açıklanabilecek / devredilebilecek, sınıflandırılabilecek ve KVKK’da sayılan şekillerde işlenebilecektir.</p>
                    <p><strong>Kişisel verilerinizin ne şekilde işlenebileceği</strong></p>
                    <p>6698 sayılı KVKK uyarınca, Firmamız ile paylaştığınız kişisel verileriniz, tamamen veya kısmen, otomatik olarak, veyahut herhangi bir veri kayıt sisteminin parçası olmak kaydıyla otomatik olmayan yollarla elde edilerek, kaydedilerek, depolanarak, değiştirilerek, yeniden düzenlenerek, kısacası veriler üzerinde gerçekleştirilen her türlü işleme konu olarak tarafımızdan işlenebilecektir. KVKK kapsamında veriler üzerinde gerçekleştirilen her türlü işlem “kişisel verilerin işlenmesi” olarak kabul edilmektedir.</p>
                    <p><strong>Kişisel verilerinizin işlenme amaçları ve hukuki sebepleri</strong></p>
                    <p><strong>Paylaştığınız kişisel veriler,</strong></p>
                    <p>· Müşterilerimize verdiğimiz hizmetlerin gereklerini, sözleşmenin ve teknolojinin gereklerine uygun şekilde yapabilmek, sunulan ürün ve hizmetlerimizi geliştirebilmek için;</p>
                    <p>· 6563 sayılı Elektronik Ticaretin Düzenlenmesi Hakkında Kanun, 6502 sayılı Tüketicinin Korunması Hakkında Kanun ile bu düzenlemelere dayanak yapılarak hazırlanan 26.08.2015 tarihli 29457 sayılı RG’de yayınlanan Elektronik Ticarette Hizmet Sağlayıcı ve Aracı Hizmet Sağlayıcılar Hakkında Yönetmelik, 27.11.2014 tarihli ve 29188 sayılı RG’de yayınlanan Mesafeli Sözleşmeler Yönetmeliği ve diğer ilgili mevzuat kapsamında işlem sahibinin bilgilerini tespit için kimlik, adres ve diğer gerekli bilgileri kaydetmek için;</p>
                    <p>· Bankacılık ve Elektronik Ödeme alanında zorunlu olan ödeme sistemleri, elektronik sözleşme veya kağıt ortamında işleme dayanak olacak tüm kayıt ve belgeleri düzenlemek; mevzuat gereği ve diğer otoritelerce öngörülen bilgi saklama, raporlama, bilgilendirme yükümlülüklerine uymak için;</p>
                    <p>· Kamu güvenliğine ilişkin hususlarda ve hukuki uyuşmazlıklarda, talep halinde ve mevzuat gereği savcılıklara, mahkemelere ve ilgili kamu görevlilerine bilgi verebilmek için;</p>
                    <p>6698 sayılı KVKK ve ilgili ikincil düzenlemelere uygun olarak işlenecektir.</p>
                    <p>Kişisel verilerinizin aktarılabileceği üçüncü kişi veya kuruluşlar hakkında bilgilendirme Yukarıda belirtilen amaçlarla, Firmamız ile paylaştığınız kişisel verilerinizin aktarılabileceği kişi / kuruluşlar; başta Web Site / Sanal Mağaza altyapımıza ilişkin çözüm ortaklarımız olmak üzere, tedarikçiler, kargo şirketleri gibi sunulan hizmetler ile ilgili kişi ve kuruluşlar, faaliyetlerimizi yürütmek üzere ve/veya Veri İşleyen sıfatı ile hizmet alınan, iş birliği yaptığımız program ortağı kuruluşları, yurtiçi / yurtdışı kuruluşlar ve diğer 3. kişilerdir.</p>
                    <p><strong>Kişisel verilerinizin toplanma şekli</strong></p>
                    <p><strong>Kişisel verileriniz,</strong></p>
                    <p>· Firmamız internet sitesi ve mobil uygulamalarındaki formlar aracılığıyla ad, soyad, TC kimlik numarası, adres, telefon, iş veya özel e-posta adresi gibi bilgiler ile; kullanıcı adı ve şifresi kullanılarak giriş yapılan sayfalardaki tercihleri, gerçekleştirilen işlemlerin IP kayıtları, tarayıcı tarafından toplanan çerez verileri ile gezinme süre ve detaylarını içeren veriler, konum verileri şeklinde;</p>
                    <p>· Satış ve pazarlama departmanı çalışanlarımız, şubelerimiz, tedarikçilerimiz, diğer satış kanalları, kağıt üzerindeki formlar, kartvizitler, dijital pazarlama ve çağrı merkezi gibi kanallarımız aracılığıyla sözlü, yazılı veya elektronik ortamdan;</p>
                    <p>· Firmamız ile ticari ilişki kurmak, iş başvurusu yapmak, teklif vermek gibi amaçlarla, kartvizit, özgeçmiş (cv), teklif vermek ve sair yollarla kişisel verilerini paylaşan kişilerden alınan, fiziki veya sanal bir ortamda, yüz yüze ya da mesafeli, sözlü veya yazılı ya da elektronik ortamdan;</p>
                    <p>· Ayrıca farklı kanallardan dolaylı yoldan elde edilen, web sitesi, blog, yarışma, anket, oyun, kampanya ve benzeri amaçlı kullanılan (mikro) web sitelerinden ve sosyal medyadan elde edilen veriler, e-bülten okuma veya tıklama hareketleri, kamuya açık veri tabanlarının sunduğu veriler, sosyal medya platformlarından paylaşıma açık profil ve verilerden;</p>
                    <p>işlenebilmekte ve toplanabilmektedir.</p>
                    <p><strong>KVKK yürürlüğe girmeden önce elde edilen kişisel verileriniz</strong></p>
                    <p>KVKK’nun yürürlük tarihi olan 7 Nisan 2016 tarihinden önce, üyelik, elektronik ileti izni, ürün / hizmet satın alma ve diğer şekillerde hukuka uygun olarak elde edilmiş olan kişisel verileriniz de bu belgede düzenlenen şart ve koşullara uygun olarak işlenmekte ve muhafaza edilmektedir.</p>
                    <p><strong>Kişisel verilerinizin yurtdışına aktarılması</strong></p>
                    <p>Türkiye’de işlenerek veya Türkiye dışında işlenip muhafaza edilmek üzere, yukarıda sayılan yöntemlerden herhangi birisi ile toplanmış kişisel verileriniz KVKK kapsamında kalmak kaydıyla ve sözleşme amaçlarına uygun olarak yurtdışında bulunan (Kişisel Veriler Kurulu tarafından akredite edilen ve kişisel verilerin korunması hususunda yeterli korumanın bulunduğu ülkelere) hizmet aracılarına da aktarılabilecektir.</p>
                    <p><strong>Kişisel verilerin saklanması ve korunması</strong></p>
                    <p>Kişisel verileriniz, Firmamız nezdinde yer alan veri tabanında ve sistemlerde KVKK’nun 12. maddesi gereğince gizli olarak saklanacak; yasal zorunluluklar ve bu belgede belirtilen düzenlemeler haricinde hiçbir şekilde üçüncü kişilerle paylaşılmayacaktır. Firmamız, kişisel verilerinizin barındığı sistemleri ve veri tabanlarını, KVKK’nun 12. Maddesi gereği kişisel verilerin hukuka aykırı olarak işlenmesini önlemekle, yetkisiz kişilerin erişimlerini engellemekle, erişim</p>
                    <p>yönetimi gibi yazılımsal tedbirleri ve fiziksel güvenlik önlemleri almakla mükelleftir. Kişisel verilerin yasal olmayan yollarla başkaları tarafından elde edilmesinin öğrenilmesi halinde durum derhal, yasal düzenlemeye uygun ve yazılı olarak Kişisel Verileri Koruma Kurulu’na bildirilecektir.</p>
                    <p><strong>Kişisel verilerin güncel ve doğru tutulması</strong></p>
                    <p>KVKK’nun 4. maddesi uyarınca Firmamızın kişisel verilerinizi doğru ve güncel olarak tutma yükümlülüğü bulunmaktadır. Bu kapsamda Firmamızın yürürlükteki mevzuattan doğan yükümlülüklerini yerine getirebilmesi için Müşterilerimizin doğru ve güncel verilerini paylaşması veya web sitesi / mobil uygulama üzerinden güncellemesi gerekmektedir.</p>
                    <p><strong>6698 sayılı KVKK uyarınca kişisel veri sahibinin hakları</strong></p>
                    <p>6698 sayılı KVKK 11.maddesi 07 Ekim 2016 tarihinde yürürlüğe girmiş olup ilgili madde gereğince, Kişisel Veri Sahibi’nin bu tarihten sonraki hakları aşağıdaki gibidir:</p>
                    <p>Kişisel Veri Sahibi, Firmamıza (veri sorumlusu) başvurarak kendisiyle ilgili;</p>
                    <ol>
                        <li>Kişisel veri işlenip işlenmediğini öğrenme,</li>
                        <li>Kişisel verileri işlenmişse buna ilişkin bilgi talep etme,</li>
                        <li>Kişisel verilerin işlenme amacını ve bunların amacına uygun kullanılıp kullanılmadığını öğrenme,</li>
                        <li>Yurt içinde veya yurt dışında kişisel verilerin aktarıldığı üçüncü kişileri bilme,</li>
                        <li>Kişisel verilerin eksik veya yanlış işlenmiş olması hâlinde bunların düzeltilmesini isteme,</li>
                        <li>KVKK’nun 7. maddesinde öngörülen şartlar çerçevesinde kişisel verilerin silinmesini veya yok edilmesini isteme,</li>
                        <li>Kişisel verilerin düzeltilmesi, silinmesi, yok edilmesi halinde bu işlemlerin, kişisel verilerin aktarıldığı üçüncü kişilere de bildirilmesini isteme,</li>
                        <li>İşlenen verilerin münhasıran otomatik sistemler vasıtasıyla analiz edilmesi suretiyle kişinin kendisi aleyhine bir sonucun ortaya çıkmasına itiraz etme,</li>
                        <li>Kişisel verilerin kanuna aykırı olarak işlenmesi sebebiyle zarara uğraması hâlinde zararın giderilmesini talep etme,</li>
                    </ol>
                    <p>haklarına sahiptir.</p>
                    <p>İstanbul Ticaret Odası’nın 36658-5 sicil sayısında kayıtlı, {{ $iletisim['adres'] }} . adresinde bulunan {{ $seo['author'] }} , KVKK kapsamında Veri Sorumlusu’dur.</p>
                    <p>Firmamız tarafından atanacak Veri Sorumlusu Temsilcisi, yasal altyapı sağlandığında Veri Sorumluları Sicilinde ve bu belgenin bulunduğu internet adresinde ilan edilecektir. Kişisel Veri Sahipleri, sorularını, görüşlerini veya taleplerini aşağıdaki iletişim kanallarından herhangi birisine yöneltebilir:</p>
                    <p>E.posta: info{{ '@'. str_replace(['http://', 'https://'], '', url('/')) }}</p>
                    <p>Telefon: {{ $iletisim['tel'] }}</p>
                </article>
                <!-- #post-## -->
            </main>
            <!-- #main -->
        </div>
        <!-- #primary -->
    </div>
</div>

@endif

@endsection

@section('custom')

<style>

    .user-panel
    {
        margin: 0;
        padding: 30px 0;
    }

    .user-panel h1
    {
        font-size: 24pt;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
        font-weight: 700;
        color: #2a313e;
    }

    .user-panel p
    {
        color: #717171;
        font-size: 11pt;
        line-height: 1.25;
    }

    .user-panel p:last-child
    {
        margin-bottom: 0;
    }

</style>

@endsection
