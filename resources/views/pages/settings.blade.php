@extends('layouts.app')

@section('content')
    <div class="c-box c-box-large u-gap-bottom">
        <div class="c-box_body row bold">
            <form method="POST" action="{{ route('saveSettings') }}" class="col col-md-12">
                @csrf
                <h3 class="u-clear-gap-top u-gap-bottom-xsmall u-text-center@md-down">
                    @lang('messages.settings')
                </h3>
                <div class="row">
                    <div class="col col-md-10 u-gap-bottom">
                        <div class="c-form-group">
                            <label class="c-label" for="language">@lang('messages.language')</label>
                            <select class="c-selectbox" id="language" name="language">
                                <option value="en">@lang('messages.english')</option>
                                <option value="sp">@lang('messages.spanish')</option>
                                <option value="de">@lang('messages.deutsch')</option>
                                <option value="tr">@lang('messages.turkish')</option>
                                <option value="ru">@lang('messages.russian')</option>
                                <option value="fr">@lang('messages.french')</option>
                            </select>
                        </div>
                    </div>
                    <div class="col col-md-2 u-text-right u-clear-gap-bottom">
                        <label class="c-label visibility">@lang('messages.save_button')</label>

                        <button type="submit"
                                class="c-button c-button-primary">@lang('messages.save_button')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
