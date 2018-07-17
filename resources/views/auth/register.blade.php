@extends('layouts.marketing.app')

@section('content')
    <div class="o-wrapper_body o-hero o-hero-background-gray o-hero-padding-ends-small js-wrapper-body">
        <div class="container">
            <div class="row">
                <div class="col col-lg-7 u-gap-bottom@md-down">
                    <div class="c-box c-box-large">
                        <div class="c-box_body">
                            <header class="u-text-center u-gap-bottom">
                                <h1 class="h2 u-clear-gap-top u-gap-bottom-xsmall">
                                    Register immediately, create your group
                                </h1>
                                <p class="u-clear-gap">Fill in the following information to register.</p>
                            </header>
                            <form method="POST" action="{{ route('register') }}" class="js-form-validation"
                                  novalidate="novalidate">
                                @csrf
                                <div class="row">
                                    <div class="col col-md-6 u-gap-bottom">
                                        <div class="c-form-group ">
                                            <label class="c-label required"
                                                   for="name">Name</label>
                                            <input id="name" type="text"
                                                   class="c-form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   name="name" value="{{ old('name') }}" required="required" autofocus
                                                   data-validetta="required,minLength[2]">

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col col-md-6 u-gap-bottom">
                                        <div class="c-form-group ">
                                            <label class="c-label required"
                                                   for="last_name">Last Name</label>
                                            <input id="last_name" type="text"
                                                   class="c-form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                                   name="last_name" value="{{ old('last_name') }}" autofocus
                                                   required="required" data-validetta="required,minLength[2]">

                                            @if ($errors->has('last_name'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col col-md-12 u-gap-bottom">
                                        <div class="c-form-group">
                                            <div class="c-form-group ">
                                                <label class="c-label required" for="email">E-mail Address</label>
                                                <input id="email" type="email"
                                                       class="c-form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                       name="email" value="{{ old('email') }}" required="required"
                                                       data-validetta="required,email">

                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-md-6 u-gap-bottom">
                                        <div class="c-form-group ">
                                            <label class="c-label required" for="password">Password</label>
                                            <input id="password" type="password"
                                                   class="c-form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                   name="password" required="required"
                                                   data-validetta="required,minLength[6],maxLength[32]"
                                                   placeholder="Please enter">

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col col-md-6 u-gap-bottom">
                                        <div class="c-form-group ">
                                            <label class="c-label required" for="password-confirm">
                                                Confirm Password
                                            </label>
                                            <input id="password-confirm" type="password"
                                                   class="c-form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                   name="password_confirmation" required="required"
                                                   data-validetta="required,minLength[6],maxLength[32]"
                                                   placeholder="Please enter">

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button class="c-button c-button-primary c-button-block u-gap-bottom-medium">
                                    Register
                                </button>
                                <p class="u-text-center">Are you already a member?</p>
                                <a href="{{ route('login') }}"
                                   class="c-button c-button-ghost c-button-block">Login Now</a>
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
