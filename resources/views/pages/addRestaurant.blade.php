@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('saveRestaurant') }}">
                @csrf
                <div class="card card-default">
                    <div class="card-header">@lang('messages.new_restaurant')</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">
                                @lang('messages.restaurant_name')
                            </label>
                            <div class="col-md-6">
                                <input id="restaurantName" type="text" class="form-control" name="restaurantName"required autofocus>
                            </div>
                            <input type="hidden" id="groupId" class="form-control" name="groupId" value={{Request::segment(3)}}>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">@lang('messages.save_button')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
