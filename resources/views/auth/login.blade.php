@extends('layouts.marketing.app')

@section('content')
    <div class="o-wrapper_body o-hero o-hero-background-gray o-hero-padding-ends-small js-wrapper-body">
        <div class="container">
            <div class="row">
                <div class="col col-lg-7 u-gap-bottom@md-down">
                    <div class="c-box c-box-large">
                        <div class="c-box_body">
                            <header class="u-text-center u-gap-bottom">
                                <h1 class="h2 u-clear-gap-top u-gap-bottom-xsmall">Login</h1>
                                <p class="u-clear-gap">Fill in the following information to log in.</p>
                            </header>
                            <form method="POST" action="{{ route('login') }}" class="js-form-validation"
                                  novalidate="novalidate">
                                @csrf
                                <div class="row">
                                    <div class="col col-md-12 u-gap-bottom">
                                        <div class="c-form-group">
                                            <label class="c-label required" for="email">E-Mail Address</label>

                                            <input id="email" type="email"
                                                   class="c-form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   name="email" value="{{ old('email') }}" required autofocus
                                                   data-validetta="required,email">

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col col-md-12 u-gap-bottom">
                                        <div class="c-form-group">
                                            <label class="c-label required" for="password">Password</label>

                                            <input id="password" type="password"
                                                   class="c-form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                   name="password" required data-validetta="required"
                                                   placeholder="Please enter password">
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">
                                                     <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col col-lg-6 u-gap-bottom ">
                                        <label>
                                            <input type="checkbox"
                                                   name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                        </label>
                                    </div>
                                    <div class="col col-lg-6 u-gap-bottom u-text-right">
                                        <a href="{{ route('password.request') }}"
                                           class="u-link-secondary u-font-size-sm"> Forgot Your Password?</a>
                                    </div>
                                </div>
                                <button type="submit"
                                        class="c-button c-button-primary c-button-block u-gap-bottom-medium">
                                    Login
                                </button>
                                <p class="u-text-center">Are not you a member?</p>
                                <a href="{{ route('register') }}" class="c-button c-button-ghost c-button-block">
                                    Register Now
                                </a>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col col-lg-5">
                    @include('layouts.marketing.slider')
                </div>
            </div>
        </div>
    </div>

@endsection
