@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content" style="width: 70%; margin: 30px auto;"> 
        <div id="accordion">
            @foreach ($datas as $data)
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#{{$data->getId()}}" aria-expanded="true"
                                aria-controls="{{$data->getId()}}">
                                {{$data->getName()}}
                            </button>
                            <span class="badge badge-secondary">{{$data->getBudget()}} ₺</span>
                        </h5>
                    </div>
                    <div id="{{$data->getId()}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <ul class="list-group">
                                {{--  <form method="POST" action="{{ route('saveAveragePrice') }}">  --}}
                                    @foreach ($data->getRestaurants() as $restaurant)
                                    <div class="row">
                                        <div class="col-md-7">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{$restaurant->getName()}}
                                            </li>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">{{$restaurant->getAveragePrice()}}</span>
                                                    <span class="input-group-text">₺</span>
                                                </div>
                                                    <input type="text" class="form-control" name="newAveragePrice" id="newAveragePrice">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-primary">Güncelle</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                {{--  </form>  --}}
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
