@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (empty($activityLogGroups))
                <div class="alert alert-danger" role="alert">
                    @lang('messages.zero_activity')!
                </div>
            @endif
            <div class="card card-default" style="margin-top: 30px;">
                <div class="card-header">@lang('messages.home')</div>
                @foreach ($generatedDatas as $generatedData)
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">
                                <span style="color: #553F7A;">{{$generatedData['generatedRestaurant']}}</span>
                            </h1>
                            <p class="lead">
                            <strong>{{$generatedData['groupName']}} </strong>Grubu için üretilen restorant tavsiyesidir
                            </p>
                            <hr class="my-4">
                                <p>
                                    Yeni bir tavsiye almak için grubun detay sayfasına gidebilir, üretilen restorant hakkında görüşünüzü aşağıdan belirtebilirsiniz
                                </p>
                                <p class="lead">
                                    <a href="#">
                                        <i class="far fa-thumbs-up fa-2x"></i>
                                    </a>
                                    <a href="#" style="margin-left:20px;">
                                        <i class="far fa-thumbs-down fa-2x"></i>
                                    </a>
                                </p>
                        </div>
                    </div>
                @endforeach
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($activityLogGroups as $activityLog)
                        <div class="card w-75 text-center" style="margin:30px auto;">
                            <div class="card-body">
                                <h5 class="card-title">@lang("messages.".$activityLog->getActivity()->getName(). "_". $activityLog->getActivity()->getTable())</h5>
                                <p class="card-text">
                                    @lang(
                                        "messages.".$activityLog->getActivity()->getTable(). "_". $activityLog->getActivity()->getName(),
                                        $activityLog->getContent()
                                    )
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
