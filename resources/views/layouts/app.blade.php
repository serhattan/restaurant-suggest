<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

<!-- Styles
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/web-fonts-with-css/css/fontawesome-all.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">
</head>
<body>
<div class="o-wrapper js-wrapper">
    <div class="o-wrapper_header ">
        <div class="c-navbar">
            <div class="container c-navbar_container">
                <a class="c-navbar_logo-link" href="/">
                    {{ config('app.name') }}
                </a>
                <div class="c-navbar_nav">
                    <ul class="c-navbar_menu">
                        <li class="c-navbar_menu-item u-hidden@sm-down">
                            <a href="{{ route('home') }}" class="c-navbar_menu-link">@lang('messages.home')</a>
                        </li>
                        <li class="c-navbar_menu-item c-dropdown c-navbar_dropdown"
                            data-dropdown-container="">
                            <a href="#" data-dropdown-toggle="">
                                <img class="c-avatar c-avatar-rounded c-avatar-small" src="{{ asset('img/user.png') }}" alt="">
                            </a>
                            <div class="c-dropdown_content" data-dropdown-content="">
                                <div class="c-box c-navbar_box c-navbar_box-user">
                                    <div class="c-box_body">
                                        <div class="row">
                                            <div class="col col-lg-6 u-gap-bottom">
                                                <a href="{{ route('groups') }}" class="c-list">
                                                    <span class="c-circle-icon c-circle-icon-green c-list_icon">
                                                       <i class="fas fa-users"></i>
                                                    </span>
                                                    <span class="c-list_content">
                                                       <span class="c-list_title">@lang('messages.groups')</span>
                                                       <span class="c-list_subtitle"></span>
                                                     </span>
                                                </a>
                                            </div>
                                            <div class="col col-lg-6 u-gap-bottom">
                                                <a href="{{ route('restaurantGenerate') }}" class="c-list">
                                                    <span class="c-circle-icon c-circle-icon-dark-blue c-list_icon">
                                                       <i class="fab fa-cloudscale"></i>
                                                    </span>
                                                    <span class="c-list_content">
                                                       <span class="c-list_title">@lang('messages.generate')</span>
                                                       <span class="c-list_subtitle"></span>
                                                     </span>
                                                </a>
                                            </div>
                                            <div class="col col-lg-6 u-gap-bottom">
                                                <a href="{{ route('restaurants') }}" class="c-list">
                                                    <span class="c-circle-icon c-circle-icon-blue c-list_icon">
                                                       <i class="fas fa-building"></i>
                                                    </span>
                                                    <span class="c-list_content">
                                                       <span class="c-list_title">@lang('messages.restaurant')</span>
                                                       <span class="c-list_subtitle"></span>
                                                     </span>
                                                </a>
                                            </div>
                                            <div class="col col-lg-6 u-gap-bottom">
                                                <a href="{{ route('history') }}" class="c-list">
                                                    <span class="c-circle-icon c-circle-icon-orange c-list_icon">
                                                       <i class="fas fa-history"></i>
                                                    </span>
                                                    <span class="c-list_content">
                                                       <span class="c-list_title">@lang('messages.history')</span>
                                                       <span class="c-list_subtitle"></span>
                                                     </span>
                                                </a>
                                            </div>
                                            <div class="col col-lg-6 u-gap-bottom">
                                                <a href="{{ route('settings') }}" class="c-list">
                                                    <span class="c-circle-icon c-circle-icon-gray c-list_icon">
                                                       <i class="fas fa-cog"></i>
                                                    </span>
                                                    <span class="c-list_content">
                                                       <span class="c-list_title"> @lang('messages.settings')</span>
                                                       <span class="c-list_subtitle"></span>
                                                     </span>
                                                </a>
                                            </div>
                                            <div class="col col-lg-6">
                                                <a href="{{ route('logout') }}" class="c-list" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                                    <span class="c-circle-icon c-circle-icon-red c-list_icon">
                                                       <i class="fa fa-sign-out-alt"></i>
                                                    </span>
                                                    <span class="c-list_content">
                                                      <span class="c-list_title">@lang('messages.logout')</span>
                                                      <span class="c-list_subtitle"></span>
                                                    </span>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                          style="display: none;">
                                                        @csrf
                                                    </form>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('new-group') }}"
                                   class="c-button c-button-primary c-button-small u-hidden@lg-up">
                                    @lang('messages.new') @lang('messages.group')
                                </a>
                                <button type="button" class="c-navbar_dropdown-close" data-dropdown-toggle="">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </li>
                    </ul>
                    <a href="{{ route('restaurantGenerate') }}" class="c-button c-button-primary c-button-small u-gap-left-small u-hidden@sm-down">
                        @lang('messages.generate')
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="o-wrapper_body o-hero o-hero-background-gray o-hero-padding-ends-small js-wrapper-body">
        <div class="container">
            @yield('content')
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/app.min.js') }}"></script>

<!-- Scripts
<script src="{{ asset('js/app.js') }}"></script>-->
</body>
</html>
