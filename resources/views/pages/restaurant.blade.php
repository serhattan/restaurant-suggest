@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content" style="width: 70%; margin: 30px auto;"> 
        <div id="accordion">
            @if (empty($datas))
                <div class="alert alert-danger" role="alert">
                    Henüz hiç restoran eklemediniz!
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
                        <a href="/restaurants/add/{{$data->getId()}}" style="float:right;">Add Restaurant</a>
                    </div>
                    <div id="{{$data->getId()}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <ul class="list-group">
                                @if (empty($data->getRestaurants()))
                                    <h5>Bu grubun bir restoranı bulunmamaktadır</h5>
                                @endif
                                @foreach ($data->getRestaurants() as $restaurant)
                                    <form method="POST" action="{{ route('saveAveragePrice') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-7">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{$restaurant->getName()}}
                                                <a name="removeRestaurantId" href="/restaurants/remove/{{$restaurant->getId()}}" style="color:red;">Remove</a>
                                            </li>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">{{$restaurant->getAveragePrice()}} ₺</span>
                                                </div>
                                                <input type="text" class="form-control" name="newAveragePrice" id="newAveragePrice" required>
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-primary">Güncelle</button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <input type="hidden" class="form-control" name="restaurantId" id="restaurantId" value="{{$restaurant->getId()}}">
                                    </form>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
