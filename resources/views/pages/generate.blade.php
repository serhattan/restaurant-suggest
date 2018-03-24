@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($groupUsers as $groupUser)
                <div class="card" style="margin-top: 30px;">
                    <div class="card-body">
                        <h5 class="card-title">{{$groupUser->getGroup()->getName()}}</h5>
                        @if(isset($generatedRestaurant))
                            <h6 class="card-subtitle mb-2 text-muted">Tavsiye Edilen Restoran</h6>
                        @endif
                        <p class="card-text">
                            {{$groupUser->getGroup()->getName()}} grubu adına restoran tavsiyesi almak için aşağıdaki butonu kullanabilirsiniz.
                        </p>
                        <a href="{{ route('generate',['groupId' => $groupUser->getGroup()->getId()]) }}" class="btn" 
                            style="background-color:#28a745;color: #fff !important;">
                            Generate
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
