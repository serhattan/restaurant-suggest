@extends('layouts.marketing.app')

@section('content')
    <div class="o-wrapper_body js-wrapper-body">
        <div class="o-hero o-hero-padding-ends-small js-sticky-jumbotron">
            <div class="container">
                <div class="row u-flex-align-middle">
                    <div class="col col-lg-6 u-text-center@md-down u-pad-ends-small@md-down">
                        <h1 class="o-hero_title u-clear-gap">Welcome to {{ config('app.name') }}</h1>
                        <h2 class="h1 u-gap-top-xsmall u-gap-bottom-xsmall">Are you think you will eat today?</h2>
                        <p>Do not think, we think for you.</p>
                        <p class="u-gap-top u-clear-gap-bottom">
                            <a href="{{ route('register') }}" class="c-button c-button-primary">
                               Let's Go
                            </a>
                        </p>
                    </div>
                    <div class="col col-lg-6">
                        <figure>
                            <img class="u-img-responsive" src="{{ asset('assets/img/home2.png') }}" width="640" alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <div
                class="o-hero o-hero-background-gray o-hero-background-gray-shape-top o-hero-padding-ends-large">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-8 col-offset-lg-2 u-text-center u-gap-bottom-large">
                        <h2 class="o-hero_title u-clear-gap">{{ config('app.name') }}</h2>
                        <h3 class="h2 u-gap-top-xsmall u-gap-bottom-xsmall">How Are We Working?</h3>
                        <p>Yatırımcılara, sana destek olmayı isteyecek mentorlara, hevesle seninle çalışmak isteyecek
                            potansiyel çalışanlara ve müşterilerine girişimini duyur.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-lg-4 u-flex u-flex-dir-column u-gap-bottom@md-down">
                        <div class="c-box c-box-small u-text-center u-flex-grow-full">
                            <div class="c-box_body">
                                <img class="u-img-responsive" src="assets/img/home-figure-1.svg" width="240" alt="">
                                <h3 class="u-gap-top-xsmall u-gap-bottom-xsmall">Girişimini Oluştur</h3>
                                <p>Girişimin görünür ve çekici olsun. Takipçilerini gelişmelerinden haberdar et.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-4 u-flex u-flex-dir-column u-gap-bottom@md-down">
                        <div class="c-box c-box-small u-text-center u-flex-grow-full">
                            <div class="c-box_body">
                                <img class="u-img-responsive" src="assets/img/home-figure-3.svg"
                                     width="240" alt="">
                                <h3 class="u-gap-top-xsmall u-gap-bottom-xsmall">Destek Al</h3>
                                <p>Gerçek potansiyelinin açığa çıkmasına destek olacak StartupMarket Danışma Kurulu’nun
                                    tecrübelerinden faydalan.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-4 u-flex u-flex-dir-column u-gap-bottom@md-down">
                        <div class="c-box c-box-small u-text-center u-flex-grow-full">
                            <div class="c-box_body">
                                <img class="u-img-responsive" src="assets/img/home-figure-2.svg"
                                     width="240" alt="">
                                <h3 class="u-gap-top-xsmall u-gap-bottom-xsmall">Yatırım Bul</h3>
                                <p>Doğru zamanda doğru yerde olabilme şansını arttır. Girişimin potansiyelini daha geniş
                                    yatırımcı kitlesine tanıt!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="giris-yap.html"
           class="c-button c-button-primary c-button-large c-button-block c-button-no-radius">Girişim Oluştur</a>
        <div class="o-hero o-hero-background-gray o-hero-background-gray-shape-bottom o-hero-padding-ends-large">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-8 col-offset-lg-2 u-text-center u-gap-bottom-large">
                        <h2 class="o-hero_title u-clear-gap">Girişimler</h2>
                        <h3 class="h2 u-gap-top-xsmall u-gap-bottom-xsmall">Yatırım Fırsatları</h3>
                        <p>StartupMarket üzerinde yatırım arayan başarılı girişimleri incele!</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-lg-4 col-md-6 u-gap-bottom-medium u-flex u-flex-dir-column">
                        <div class="c-box c-box-small u-flex-grow-full">
                            <a href="shopsta.html" class="c-box_header">
                                <img class="u-full-width"
                                     src="cache/360x180/upload/images/startup/5a741fae83925080551713.jpg" alt="">
                            </a>
                            <div class="c-box_body">
                                <div class="c-user-card u-gap-bottom-small">
                                    <a class="c-user-card_image" href="shopsta.html">
                                        <img class="c-avatar"
                                             src="cache/100x100/upload/images/startup/5a7bfbda927fe506714893.jpg"
                                             alt="Shopsta Logo">
                                    </a>
                                    <div class="c-user-card_body">
                                        <a href="shopsta.html" class="c-user-card_title">Shopsta</a>
                                        <span class="c-user-card_subtitle">İzmir, Türkiye</span>
                                    </div>
                                </div>
                                <p class="u-clear-gap">
                                    Instagram&#039;dan alışveriş hiç bu kadar kolay olmamıştı!
                                </p>
                            </div>
                            <div class="c-box_footer">
                                <a href="shopsta.html" class="c-button c-button-ghost c-button-block">İncele</a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-4 col-md-6 u-gap-bottom-medium u-flex u-flex-dir-column">
                        <div class="c-box c-box-small u-flex-grow-full">
                            <a href="simulapp-mobil-simulasyon-platformu.html" class="c-box_header">
                                <img class="u-full-width"
                                     src="cache/360x180/upload/images/startup/5ab529ec34943940694986.jpg" alt="">
                            </a>
                            <div class="c-box_body">
                                <div class="c-user-card u-gap-bottom-small">
                                    <a class="c-user-card_image" href="simulapp-mobil-simulasyon-platformu.html">
                                        <img class="c-avatar"
                                             src="cache/100x100/upload/images/startup/5ab1204ab7f0f798213735.jpg"
                                             alt="SimulApp Mobil Simülasyon Platformu Logo">
                                    </a>
                                    <div class="c-user-card_body">
                                        <a href="simulapp-mobil-simulasyon-platformu.html" class="c-user-card_title">SimulApp
                                            Mobil Simülasyon Platformu</a>
                                        <span class="c-user-card_subtitle">İstanbul, Türkiye</span>
                                    </div>
                                </div>
                                <p class="u-clear-gap">
                                    Dakikalar içerisinde mobil simülasyonunuz hazır!
                                </p>
                            </div>
                            <div class="c-box_footer">
                                <a href="simulapp-mobil-simulasyon-platformu.html"
                                   class="c-button c-button-ghost c-button-block">İncele</a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-4 col-md-6 u-gap-bottom-medium u-flex u-flex-dir-column">
                        <div class="c-box c-box-small u-flex-grow-full">
                            <a href="doktorderki.html" class="c-box_header">
                                <img class="u-full-width"
                                     src="cache/360x180/upload/images/startup/5ab9045c34195548615680.jpg" alt="">
                            </a>
                            <div class="c-box_body">
                                <div class="c-user-card u-gap-bottom-small">
                                    <a class="c-user-card_image" href="doktorderki.html">
                                        <img class="c-avatar"
                                             src="cache/100x100/upload/images/startup/5ab9043a3496f349094059.jpg"
                                             alt="Doktorderki Logo">
                                    </a>
                                    <div class="c-user-card_body">
                                        <a href="doktorderki.html" class="c-user-card_title">Doktorderki</a>
                                        <span class="c-user-card_subtitle">İstanbul, Türkiye</span>
                                    </div>
                                </div>
                                <p class="u-clear-gap">
                                    Doktora soru sormanın en kolay yolu!
                                </p>
                            </div>
                            <div class="c-box_footer">
                                <a href="doktorderki.html" class="c-button c-button-ghost c-button-block">İncele</a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-4 col-md-6 u-gap-bottom-medium u-flex u-flex-dir-column">
                        <div class="c-box c-box-small u-flex-grow-full">
                            <a href="pandora.html" class="c-box_header">
                                <img class="u-full-width"
                                     src="cache/360x180/upload/images/startup/5a8536bf373d9926387516.jpg" alt="">
                            </a>
                            <div class="c-box_body">
                                <div class="c-user-card u-gap-bottom-small">
                                    <a class="c-user-card_image" href="pandora.html">
                                        <img class="c-avatar"
                                             src="cache/100x100/upload/images/startup/5a85365576a43835739879.jpg"
                                             alt="Pandora Logo">
                                    </a>
                                    <div class="c-user-card_body">
                                        <a href="pandora.html" class="c-user-card_title">Pandora</a>
                                        <span class="c-user-card_subtitle">İzmir, Türkiye</span>
                                    </div>
                                </div>
                                <p class="u-clear-gap">
                                    Help your customers to better visualize their projects
                                </p>
                            </div>
                            <div class="c-box_footer">
                                <a href="pandora.html" class="c-button c-button-ghost c-button-block">İncele</a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-4 col-md-6 u-gap-bottom-medium u-flex u-flex-dir-column">
                        <div class="c-box c-box-small u-flex-grow-full">
                            <a href="twentify.html" class="c-box_header">
                                <img class="u-full-width"
                                     src="cache/360x180/upload/images/startup/5a83123f6fba1077249096.jpg" alt="">
                            </a>
                            <div class="c-box_body">
                                <div class="c-user-card u-gap-bottom-small">
                                    <a class="c-user-card_image" href="twentify.html">
                                        <img class="c-avatar"
                                             src="cache/100x100/upload/images/startup/5a831137c4232917067605.jpg"
                                             alt="Twentify Logo">
                                    </a>
                                    <div class="c-user-card_body">
                                        <a href="twentify.html" class="c-user-card_title">Twentify</a>
                                        <span class="c-user-card_subtitle">İstanbul, Türkiye</span>
                                    </div>
                                </div>
                                <p class="u-clear-gap">
                                    Pazar Araştırması Artık Daha Akıllı
                                </p>
                            </div>
                            <div class="c-box_footer">
                                <a href="twentify.html" class="c-button c-button-ghost c-button-block">İncele</a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-4 col-md-6 u-gap-bottom-medium u-flex u-flex-dir-column">
                        <div class="c-box c-box-small u-flex-grow-full">
                            <a href="minorpreneurs.html" class="c-box_header">
                                <img class="u-full-width"
                                     src="cache/360x180/upload/images/startup/5a882c37a14f9366970391.jpg" alt="">
                            </a>
                            <div class="c-box_body">
                                <div class="c-user-card u-gap-bottom-small">
                                    <a class="c-user-card_image" href="minorpreneurs.html">
                                        <img class="c-avatar"
                                             src="cache/100x100/upload/images/startup/5a870075b55c0872465056.jpg"
                                             alt="Minorpreneurs Logo">
                                    </a>
                                    <div class="c-user-card_body">
                                        <a href="minorpreneurs.html" class="c-user-card_title">Minorpreneurs</a>
                                        <span class="c-user-card_subtitle">İstanbul, Türkiye</span>
                                    </div>
                                </div>
                                <p class="u-clear-gap">
                                    Potansiyelini Keşfet!
                                </p>
                            </div>
                            <div class="c-box_footer">
                                <a href="minorpreneurs.html" class="c-button c-button-ghost c-button-block">İncele</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-4 col-offset-md-4 col-sm-6 col-offset-sm-3">
                        <a href="girisimler.html"
                           class="c-button c-button-link c-button-block">Tümünü Görüntüle</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="o-hero o-hero-padding-top-large o-hero-padding-bottom-xsmall">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-8 col-offset-lg-2 u-text-center u-gap-bottom-large">
                        <h2 class="o-hero_title u-clear-gap">Girişimciler</h2>
                        <h3 class="h2 u-gap-top-xsmall u-gap-bottom-xsmall">Girişimcilerden Mesajlar</h3>
                        <p>Nasıl Yaptılar? Neyi Farklı Yaptılar? Ne Öneriyorlar? Siz nasıl yapabilirsiniz?</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-slider c-slider-startups">
            <div class="js-startups">
                <div class="c-slider_item">
                    <img class="u-full-width" src="assets/img/startup-slider/melodi.jpg" alt="">
                    <div class="c-slider-startups_content">
                        <p class="c-slider-startups_title">Girişimcilik tek bir noktadaki başarı hedefi değildir; yol
                            boyunca gelecek fırsatları iyi değerlendirebilmek ve yön değiştirebilme kabiliyetidir.</p>
                        <p class="c-slider-startups_subtitle u-clear-gap">Melodi Türkili,
                            <strong>NOA Agency</strong></p>
                    </div>
                </div>
                <div class="c-slider_item">
                    <img class="u-full-width" src="assets/img/startup-slider/duygu_aynur.jpg" alt="">
                    <div class="c-slider-startups_content">
                        <p class="c-slider-startups_title">Her sabah yaratma, üretme heyecanıyla kalkıyorsanız
                            girişiminiz peşinden gitmeye değer demektir. Sadece başlamak için vakit kaybetmeyin, hız,
                            başarı ve motivasyon için çok önemli.</p>
                        <p class="c-slider-startups_subtitle u-clear-gap">Duygu Aynur,
                            <strong>Carbon</strong></p>
                    </div>
                </div>
                <div class="c-slider_item">
                    <img class="u-full-width" src="assets/img/startup-slider/emre_semercioglu.jpg" alt="">
                    <div class="c-slider-startups_content">
                        <p class="c-slider-startups_title">Girişimci olarak herkese karşı açık olmaya çalışın,
                            rakiplerinizle iletişim kurun ve bilginizi paylaşın, bu size yeni kapılar açacaktır.</p>
                        <p class="c-slider-startups_subtitle u-clear-gap">Emre Semercioğlu,
                            <strong>Local Guddy</strong></p>
                    </div>
                </div>
                <div class="c-slider_item">
                    <img class="u-full-width" src="assets/img/startup-slider/ilker-elal.jpg" alt="">
                    <div class="c-slider-startups_content">
                        <p class="c-slider-startups_title">Dünyayı değiştirebilmek için A.S.İ. olmalısınız! Azimli,
                            Sabırlı ve İnançlı! Sabırlı olun ve daima kendinize inanın!</p>
                        <p class="c-slider-startups_subtitle u-clear-gap">İlker Elal,
                            <strong>Minorpreneurs</strong></p>
                    </div>
                </div>
                <div class="c-slider_item">
                    <img class="u-full-width" src="assets/img/startup-slider/soner.jpg" alt="">
                    <div class="c-slider-startups_content">
                        <p class="c-slider-startups_title">İlk önce kendinizin melek yatırımcısı olun ve kendizine
                            güvenin.</p>
                        <p class="c-slider-startups_subtitle u-clear-gap">Soner Hacıhaliloğlu,
                            <strong>Positive Enerji</strong></p>
                    </div>
                </div>
                <div class="c-slider_item">
                    <img class="u-full-width" src="assets/img/startup-slider/percin_imrek.jpg" alt="">
                    <div class="c-slider-startups_content">
                        <p class="c-slider-startups_title">Herşeyden önemlisi, girişimci kendisine ilham veren, mutlu
                            eden ve &#039;neden&#039;ini bulduğu şeyi yapmalıdır. Sonrası kolaydır.</p>
                        <p class="c-slider-startups_subtitle u-clear-gap">Perçin İmrek,
                            <strong>Bosphorus Story House</strong></p>
                    </div>
                </div>
            </div>
            <button
                    class="c-circle-icon c-circle-icon-white-outline c-slider_button c-slider_button-left js-startups-left">
                <svg class="icon c-circle-icon_icon">
                    <use xlink:href="#icon-chevron-left"></use>
                </svg>
            </button>
            <button
                    class="c-circle-icon c-circle-icon-white-outline c-slider_button c-slider_button-right js-startups-right">
                <svg class="icon c-circle-icon_icon">
                    <use xlink:href="#icon-chevron-right"></use>
                </svg>
            </button>
        </div>
        <div class="o-hero o-hero-padding-ends-large">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-8 col-offset-lg-2 u-text-center u-gap-bottom-large">
                        <h2 class="o-hero_title u-clear-gap">Danışmanlar</h2>
                        <h3 class="h2 u-gap-top-xsmall u-gap-bottom-xsmall">Mentor, Danışman ve Uzmanlarımız</h3>
                        <p>Başarılı girişimlere ışık tutan Mentor, Danışman ve Uzmanlarımız ile hemen tanış!</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-lg-4 col-sm-6 u-gap-bottom-large">
                        <div class="c-user-card">
  <span class="c-user-card_image">
        <img class="c-avatar" src="cache/100x100/upload/images/advisor/5a7316a311858816684973.jpg" alt="">
  </span>
                            <div class="c-user-card_body">
                                <a href="http://linkedin.com/in/ahmet-giray-ölmez-aa886828" target="_blank"
                                   rel="noopener" class="c-user-card_title">Ahmet Giray Ölmez</a>
                                <span class="c-user-card_subtitle">Director of Business Operations @ Pfizer Eastern Europe Cluster</span>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-4 col-sm-6 u-gap-bottom-large">
                        <div class="c-user-card">
  <span class="c-user-card_image">
        <img class="c-avatar" src="cache/100x100/upload/images/advisor/5a7321ffb6631010410584.jpg" alt="">
  </span>
                            <div class="c-user-card_body">
                                <a href="https://linkedin.com/in/ozan-kuscu-74640611" target="_blank" rel="noopener"
                                   class="c-user-card_title">Ozan Kuscu</a>
                                <span class="c-user-card_subtitle">Managing Partner @ NAR Eğitim</span>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-4 col-sm-6 u-gap-bottom-large">
                        <div class="c-user-card">
  <span class="c-user-card_image">
        <img class="c-avatar" src="cache/100x100/upload/images/advisor/5a7317ec0e92b334819654.jpg" alt="">
  </span>
                            <div class="c-user-card_body">
                                <a href="https://linkedin.com/in/alpayakdemir" target="_blank" rel="noopener"
                                   class="c-user-card_title">Alpay Akdemir</a>
                                <span class="c-user-card_subtitle">Partner @ Peppers &amp; Rogers Istanbul</span>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-4 col-sm-6 u-gap-bottom-large">
                        <div class="c-user-card">
  <span class="c-user-card_image">
        <img class="c-avatar" src="cache/100x100/upload/images/advisor/5a731a4f121f4853888341.jpg" alt="">
  </span>
                            <div class="c-user-card_body">
                                <a href="https://linkedin.com/in/dogantaskent" target="_blank" rel="noopener"
                                   class="c-user-card_title">Doğan Taşkent</a>
                                <span class="c-user-card_subtitle">Technology Transfer Accelerator Advisor</span>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-4 col-sm-6 u-gap-bottom-large">
                        <div class="c-user-card">
  <span class="c-user-card_image">
        <img class="c-avatar" src="cache/100x100/upload/images/advisor/5a731c1296715103601103.jpg" alt="">
  </span>
                            <div class="c-user-card_body">
                                <a href="https://linkedin.com/in/emreacikel" target="_blank" rel="noopener"
                                   class="c-user-card_title">Emre Açıkel</a>
                                <span class="c-user-card_subtitle">eBusiness Leader @ P&amp;G Switzerland</span>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-4 col-sm-6 u-gap-bottom-large">
                        <div class="c-user-card">
  <span class="c-user-card_image">
        <img class="c-avatar" src="cache/100x100/upload/images/advisor/5a7318fa5b8c2885712321.jpg" alt="">
  </span>
                            <div class="c-user-card_body">
                                <a href="https://linkedin.com/in/denizoktar" target="_blank" rel="noopener"
                                   class="c-user-card_title">Deniz Oktar</a>
                                <span class="c-user-card_subtitle">Kurucu Ortak @ VNGRS</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-4 col-offset-md-4 col-sm-6 col-offset-sm-3">
                        <a href="danisma-kurulu.html" class="c-button c-button-link c-button-block">Tümünü
                            Görüntüle</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="o-hero o-hero-background-dark-blue o-hero-overlay-shape o-hero-padding-ends-large">
            <div class="container">
                <div class="row u-flex-align-middle">
                    <div class="col col-lg-6 u-gap-bottom@md-down">
                        <h2 class="u-clear-gap u-color-white">Mentor, Danışman ve Uzmanlarımız Arasına Katıl</h2>
                        <p class="u-color-white">Girişimlerin büyümesine destek olan büyük ailenin parçası ol.</p>
                    </div>
                    <div class="col col-lg-4 col-offset-lg-2">
                        <a href="danisma-kurulu-basvurusu.html" class="c-button c-button-white c-button-block">Danışmanlarımız
                            Arasına Katıl</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection