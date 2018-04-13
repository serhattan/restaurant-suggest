@extends('layouts.marketing.app')

@section('content')
    <div class="o-wrapper_body js-wrapper-body">
        <div class="o-hero o-hero-padding-ends-small js-sticky-jumbotron">
            <div class="container">
                <div class="row u-flex-align-middle">
                    <div class="col col-lg-6 u-text-center@md-down u-pad-ends-small@md-down">
                        <h1 class="o-hero_title u-clear-gap">
                            indecisive's guide to the restaurant
                        </h1>
                        <h2 class="h1 u-gap-top-xsmall u-gap-bottom-xsmall">
                            What will you eat today?
                        </h2>
                        <p>
                            Do not dealing in vain we will decide for you.
                        </p>
                        <p class="u-gap-top u-clear-gap-bottom">
                            <a href="{{ route('register') }}" class="c-button c-button-primary">
                                Just Come in.
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
        <div class="o-hero o-hero-background-gray o-hero-background-gray-shape-top o-hero-padding-ends-large">
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
                                <img class="u-img-responsive" src="assets/img/home-figure-3.svg" width="240" alt="">
                                <h3 class="u-gap-top-xsmall u-gap-bottom-xsmall">Grubunu Oluştur</h3>
                                <p>Arkadaşlarını da dahil edeceğin bir grup kur ve grubun aylık bütçesini belirle.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-4 u-flex u-flex-dir-column u-gap-bottom@md-down">
                        <div class="c-box c-box-small u-text-center u-flex-grow-full">
                            <div class="c-box_body">
                                <img class="u-img-responsive" src="assets/img/home-figure-2.svg" width="240" alt="">
                                <h3 class="u-gap-top-xsmall u-gap-bottom-xsmall">
                                    Restoranları Ekle
                                </h3>
                                <p>
                                    Gideceğin restoranları ekle ve arkadaşlarınla ortak bir bütçe belirleyebilmek için kendi fiyat aralığını gir.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-4 u-flex u-flex-dir-column u-gap-bottom@md-down">
                        <div class="c-box c-box-small u-text-center u-flex-grow-full">
                            <div class="c-box_body">
                                <img class="u-img-responsive" src="assets/img/home-figure-1.svg" width="240" alt="">                            
                                <h3 class="u-gap-top-xsmall u-gap-bottom-xsmall">Tavsiyeni al</h3>
                                <p>
                                    Artık tek yapman gereken tavsiye al butonuna basıp arkana yaslanmak. Sana en iyi restoranı sunacağız.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="giris-yap.html" class="c-button c-button-primary c-button-large c-button-block c-button-no-radius">
           Grubunu Kur
        </a>
    </div>
@endsection