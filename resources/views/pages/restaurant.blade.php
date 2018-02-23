@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content" style="width: 70%; margin: 30px auto;"> 
        <div id="accordion">
            @if (empty($datas))
                <div class="alert alert-danger" role="alert">
                    @lang('messages.zero_restaurant')!
                </div>
            @endif
            @foreach ($datas as $data)
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#{{$data->getId()}}" aria-expanded="true"
                                aria-controls="{{$data->getId()}}">
                                {{$data->getName()}}
                                <span class="badge badge-secondary">{{$data->getBudget()}} ₺</span>
                            </button>
                        </h5>
                        <a href="/restaurants/add/{{$data->getId()}}" style="float:right;">@lang('messages.add_restaurant')</a>
                    </div>
                    <div id="{{$data->getId()}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <ul class="list-group">
                                @if (empty($data->getRestaurants()))
                                    <h5>@lang('messages.group_not_have_restaurant')</h5>
                                @else

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">@lang('messages.restaurant_name')</th>
                                            <th scope="col">@lang('messages.your_budget_per_restaurant')</th>
                                            <th scope="col">@lang('messages.to_update_your_budget_per_restaurant')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->getRestaurants() as $restaurant)
                                        <tr>
                                            <td>
                                                <a name="removeRestaurantId" href="/restaurants/remove/{{$restaurant->getId()}}" style="color:red;">
                                                    @lang('messages.remove')
                                                </a>
                                            </td>
                                            <td>{{$restaurant->getName()}}</td>
                                            <td>
                                                <div class="input-group">
                                                    @if(!empty($restaurant->getRestaurantUsers()))
                                                        <span class="input-group-text">{{$restaurant->getRestaurantUsers()->getBudget()}} ₺</span>
                                                    @else
                                                        <span class="input-group-text">0 ₺</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <form method="POST" action="{{ route('saveBudget') }}">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="budget" id="budget" required>
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-primary">@lang('messages.update')</button>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" class="form-control" name="restaurantId" id="restaurantId" value="{{$restaurant->getId()}}">                                                    
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
