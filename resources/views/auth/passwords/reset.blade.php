@extends('layouts.app')

@section('content')
    <div class="o-wrapper_body o-hero o-hero-background-gray o-hero-padding-ends-small js-wrapper-body">
        <div class="container">
            <div class="row">
                <div class="col col-lg-7">
                    <div class="c-box c-box-large">
                        <div class="c-box_body">
                            <header class="u-text-center u-gap-bottom">
                                <h1 class="h2 u-clear-gap-top u-gap-bottom-xsmall">Reset Password</h1>
                                <p class="u-clear-gap">Parolanı nasıl sıfırlayacağına ilişkin talimatları sana
                                    e-postayla göndereceğiz.</p>
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                            </header>
                            <form action="{{ route('password.request') }}" method="post" class="js-form-validation"
                                  novalidate="novalidate">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="row">
                                    <div class="col col-md-12 u-gap-bottom">
                                        <div class="c-form-group ">
                                            <label class="c-label required" for="email">E-Mail Address</label>
                                            <input type="email" id="email" name="email" required="required"
                                                   class="c-form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   data-validetta="required,email" value="{{ old('email') }}"/>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-12 u-gap-bottom">
                                        <div class="c-form-group ">
                                            <label class="c-label required" for="password">Password</label>
                                            <input type="password" id="password" name="password" required="required"
                                                   class="c-form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                   data-validetta="required" value="{{ old('password') }}"/>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-12 u-gap-bottom">
                                        <div class="c-form-group ">
                                            <label class="c-label required" for="password_confirmation">Password</label>
                                            <input type="password" id="password_confirmation"
                                                   name="password_confirmation" required="required"
                                                   class="c-form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                                   data-validetta="required"
                                                   value="{{ old('password_confirmation') }}"/>

                                            @if ($errors->has('password_confirmation'))
                                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button class="c-button c-button-primary c-button-block u-gap-bottom-medium">
                                    Reset Password
                                </button>
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
