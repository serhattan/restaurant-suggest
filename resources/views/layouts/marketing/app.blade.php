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
</div>

<script src="{{ asset('assets/js/app.min.js') }}"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-63399718-2"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-63399718-2');
</script>

</body>
</html>
