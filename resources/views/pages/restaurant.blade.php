@extends('layouts.app')

@section('content')
    @if (empty($datas))
        <div class="c-box c-box-large u-gap-bottom">
            <div class="c-box_body row bold">
                @lang('messages.zero_restaurant')!
            </div>
        </div>
    @endif
    @foreach ($datas as $data)
        <div class="row">
            <div class="col-md-12">
                <div class="c-box c-box-large u-gap-bottom">
                    <div class="c-box_body row">
                        <div class="col-md-12">
                            <h3 class="u-clear-gap-top">
                                <a href="/restaurants/add/{{$data->getId()}}" class="float-right">
                                    <i class="fas fa-plus-circle"></i>
                                </a>
                                {{$data->getName()}} - {{$data->getBudget()}}@lang('messages.currency_icon')
                            </h3>
                        </div>
                        <div class="col-md-12">
                            @if (empty($data->getRestaurants()))
                                <div class="c-box c-box-large u-gap-bottom">
                                    <div class="c-box_body row bold">
                                        @lang('messages.group_not_have_restaurant')
                                    </div>
                                </div>
                            @else
                                <div class="c-box c-box-large u-gap-bottom">
                                    <div class="c-box_body row bold">
                                        <div class="col col-md-3 ">
                                            @lang('messages.restaurant_name')
                                        </div>
                                        <div class="col col-md-6">
                                            @lang('messages.to_update_your_budget_per_restaurant')
                                        </div>
                                        <div class="col col-md-3">
                                            #
                                        </div>
                                    </div>
                                </div>
                                @foreach ($data->getRestaurants() as $restaurant)
                                    <div class="c-box c-box-large u-gap-bottom">
                                        <div class="c-box_body row">
                                            <div class="col col-md-3">
                                                {{$restaurant->getName()}}
                                            </div>
                                            <div class="col col-md-6">
                                                <form method="POST" action="{{ route('saveBudget') }}">
                                                    @csrf
                                                    <div class="c-form-group row">
                                                        <div class="col-md-6">
                                                            <input type="number" id="budget"
                                                                   name="budget" required="required"
                                                                   class="c-form-control"
                                                                   placeholder="@lang('messages.your_budget_per_restaurant')"
                                                                   value="{{!empty($restaurant->getRestaurantUsers()) ? $restaurant->getRestaurantUsers()->getBudget() : 0}}">
                                                        </div>
                                                        <div class="col-md-6 float-right">
                                                            <button type="submit"
                                                                    class="c-button c-button-success c-button-block u-gap-bottom-small">
                                                                @lang('messages.update')
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" class="form-control"
                                                           name="restaurantId" id="restaurantId"
                                                           value="{{$restaurant->getId()}}">
                                                    <input type="hidden" class="form-control"
                                                           name="restaurantName" id="restaurantName"
                                                           value="{{$restaurant->getName()}}">
                                                </form>
                                            </div>
                                            <div class="col col-md-3">
                                                <a href="/restaurants/remove/{{$restaurant->getId()}}"
                                                   class="c-button c-button-danger c-button-block u-gap-bottom-small">
                                                    <span class="u-flex u-flex-align-middle">
                                                        <span class="u-flex-grow-full">@lang('messages.remove')</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
