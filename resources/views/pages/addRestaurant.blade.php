@extends('layouts.app')

@section('content')
    <div class="c-box c-box-large u-gap-bottom">
        <div class="c-box_body row bold">
            <form method="POST" action="{{ route('saveRestaurant') }}" class="col col-md-12">
                @csrf
                <h3 class="u-clear-gap-top u-gap-bottom-xsmall u-text-center@md-down">
                    @lang('messages.new_restaurant')
                </h3>
                <div class="row">
                    <div class="col col-md-6 u-gap-bottom">
                        <div class="c-form-group">
                            <label class="c-label" for="language">@lang('messages.restaurant_name')</label>
                            <input id="restaurantName" type="text" class="c-form-control" name="restaurantName"
                                   required autofocus>
                        </div>
                    </div>
                    <div class="col col-md-6 u-gap-bottom">
                        <div class="c-form-group">
                            <label class="c-label" for="language">@lang('messages.restaurant_distance')</label>
                            <input id="distance" type="number" class="c-form-control"
                                   name="distance" required autofocus>
                            <small>
                                @foreach($restaurants as $restaurant)
                                    {{$restaurant->getName()}}: {{$restaurant->getDistance()}}
                                @endforeach
                            </small>
                        </div>
                    </div>
                    <div class="col col-md-12 u-text-right u-clear-gap-bottom">
                        <input type="hidden" id="groupId" class="form-control" name="groupId"
                               value={{Request::segment(3)}}>
                        <button type="submit"
                                class="c-button c-button-primary">@lang('messages.save_button')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
