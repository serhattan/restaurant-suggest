@extends('layouts.app')

@section('content')
    <div class="c-box c-box-large u-gap-bottom">
        <div class="c-box_body row bold">
            <form method="POST" action="{{ route('new-group') }}" class="col col-md-12">
                @csrf
                <h3 class="u-clear-gap-top u-gap-bottom-xsmall u-text-center@md-down">
                    @lang('messages.new') @lang('messages.group')
                </h3>
                <div class="row">
                    <div class="col col-md-6 u-gap-bottom">
                        <div class="c-form-group">
                            <label class="c-label" for="language">@lang('messages.name')</label>
                            <input id="name" type="text"
                                   class="c-form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="col col-md-6 u-gap-bottom">
                        <div class="c-form-group">
                            <label class="c-label" for="language">@lang('messages.budget')</label>
                            <input id="budget" type="number"
                                   class="c-form-control{{ $errors->has('budget') ? ' is-invalid' : '' }}"
                                   name="budget" value="{{ old('budget') }}" required autofocus>

                            @if ($errors->has('budget'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('budget') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="col col-md-12 u-text-right u-clear-gap-bottom">
                        <button type="submit"
                                class="c-button c-button-primary">@lang('messages.add_new_group')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
