<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">

</head>
<body>
<div class="o-wrapper js-wrapper">
    <div class="o-wrapper_header o-wrapper-sticky js-sticky-navbar">
        <div class="c-navbar">
            <div class="container c-navbar_container">
                <a class="c-navbar_logo-link" href="{{ route('welcome') }}">
                    {{ config('app.name') }}
                </a>
                <div class="c-navbar_nav">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('home') }}"
                               class="c-button c-button-ghost c-button-small u-gap-left-xsmall">
                                Home
                            </a>
                            @else
                                <a href="{{ route('login') }}"
                                   class="c-button c-button-ghost c-button-small u-gap-left-xsmall">
                                    Login
                                </a>
                                <a href="{{ route('register') }}"
                                   class="c-button c-button-primary c-button-small u-gap-left-xsmall u-hidden@xs-down">
                                    Register
                                </a>
                                @endauth
                            @endif
                </div>
            </div>
        </div>
    </div>
    @yield('content')
    <div class="o-wrapper_footer">
        <footer class="o-hero o-hero-padding-ends-small">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 u-gap-bottom@md-down">
                        {{ config('app.name') }}
                    </div>
                    <div class="col col-lg-2 col-sm-4">
                        <h6 class="o-hero_title u-hidden@xs-down">{{ config('app.name') }}</h6>
                        <a href="hakkimizda.html" class="u-block u-link-secondary u-gap-bottom-xsmall">About</a>
                        <a href="ekip.html" class="u-block u-link-secondary u-gap-bottom-xsmall">Team</a>
                    </div>
                    <div class="col col-lg-2 col-sm-4 u-hidden@xs-down">
                        <h6 class="o-hero_title">Contracts</h6>
                        <a href="sozlesmeler/uyelik-sozlesmesi.html"
                           class="u-block u-link-secondary u-gap-bottom-xsmall">Privacy Policy</a>
                        <a href="sozlesmeler/gizlilik-politikasi.html"
                           class="u-block u-link-secondary u-gap-bottom-xsmall">User Agreement</a>
                    </div>
                    <div class="col col-lg-2 col-sm-4 u-hidden@xs-down">
                        <h6 class="o-hero_title">İletişim</h6>
                        <a href="https://www.linkedin.com/company/startupmarket/" target="blank" rel="noopener"
                           class="u-block u-link-secondary u-gap-bottom-xsmall">Linkedin</a>
                        <a href="https://www.angel.co/startup_market/" target="blank" rel="noopener"
                           class="u-block u-link-secondary u-gap-bottom-xsmall">Angelist</a>
                        <a href="https://www.twitter.com/StartupMarketSM" target="blank" rel="noopener"
                           class="u-block u-link-secondary u-gap-bottom-xsmall">Twitter</a>
                        <a href="https://www.instagram.com/_startupmarket_/" target="blank" rel="noopener"
                           class="u-block u-link-secondary u-gap-bottom-xsmall">Instagram</a>
                        <a href="https://www.facebook.com/StartupMarketSM/" target="blank" rel="noopener"
                           class="u-block u-link-secondary u-gap-bottom-xsmall">Facebook</a>
                        <a href="https://www.youtube.com/channel/UCTtamtROyi5A2ycj0xXtkbA?disable_polymer=true"
                           target="blank" rel="noopener"
                           class="u-block u-link-secondary u-gap-bottom-xsmall">YouTube</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<div class="c-modal  c-modal-xsmall" id="coming-soon">
    <div class="container c-modal_container js-modal-container">
        <div class="c-box c-box-medium">
            <div class="c-box_body">
                <div class="u-text-center u-pad-sides-small">
                    <img class="u-img-responsive" src="assets/img/modal-rocket.svg" width="250" alt="Yakında">
                    <h3>Yakında!</h3>
                    <p class="u-clear-gap">Bu özellik çok yakında aktif olacak. Bu ve diğer tüm yeniliklerden haberdar
                        olmak için bizi takip edebilirsin.</p>
                </div>
                <button class="c-modal_close-button js-modal-close"></button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>
</html>
