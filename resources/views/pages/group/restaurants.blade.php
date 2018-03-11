@extends('pages.groups')

@section('group-content')
    <div class="col-md-9">
        <div class="card card-default">
            <div class="card-header">{{ $group->getName() }} - @lang('messages.group_restaurants')
                <a href="{{ route('addRestaurant', ['groupId' => $group->getId()]) }}" class="float-right"><i
                            class="fas fa-plus-circle"></i></a>
            </div>
            <div class="card-body">
                @if (empty($group->getRestaurants()))
                    <h5>@lang('messages.group_not_have_restaurant')</h5>
                @endif
                @foreach ($group->getRestaurants() as $restaurant)
                    <div class="row">
                        <div class="col-md-8">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{$restaurant->getName()}}
                                - {{$restaurant->getAveragePrice()}}@lang('messages.currency_icon')
                            </li>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection