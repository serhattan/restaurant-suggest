@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ route('saveSettings') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">@lang('messages.language')</label>
                        </div>
                        <select class="custom-select" id="language" name="language">
                            <option value="en">@lang('messages.english')</option>
                            <option value="sp">@lang('messages.spanish')</option>
                            <option value="de">@lang('messages.deutsch')</option>
                            <option value="tr">@lang('messages.turkish')</option>
                            <option value="ru">@lang('messages.russian')</option>
                            <option value="fr">@lang('messages.french')</option>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">@lang('messages.save_button')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
