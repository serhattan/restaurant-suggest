@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (empty($groups))
                    <div class="alert alert-danger" role="alert">
                        Herhangi bir grup bulunamadığı için generate işlemi yapılamıyor!
                    </div>
                @endif
                @foreach($groups as $group)
                    <div class="card" style="margin-bottom: 30px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $group->getName() }}</h5>
                            <p class="card-text">
                                {{$group->getName()}} grubu adına restoran tavsiyesi almak için
                                aşağıdaki butonu kullanabilirsiniz.
                            </p>
                            <a href="{{ route('generate',['groupId' => $group->getId()]) }}"
                               class="btn btn-success text-white">
                                Generate
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
