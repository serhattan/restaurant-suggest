@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (empty($activityLogGroups) && empty($generatedDatas))
                <div class="alert alert-danger" role="alert">
                    @lang('messages.zero_activity')!
                </div>
            @else
                <div class="card card-default" style="margin-top: 30px;">
                    <div class="card-header">@lang('messages.home')</div>
                    @foreach ($generatedDatas as $generatedData)
                        @if (!empty($generatedData['generatedRestaurant']))
                            <div class="jumbotron jumbotron-fluid">
                                <div class="container">
                                    <h1 class="display-4">
                                        <span style="color: #553F7A;">{{$generatedData['generatedRestaurant']}}</span>
                                    </h1>
                                    <h6 class="jumbotron-subtitle mb-2 text-muted">
                                        @for ($i = 0; $i < $generatedData['likeCount']; $i++)
                                            <i class="far fa-thumbs-up"></i>
                                        @endfor
                                        @for ($i = 0; $i < $generatedData['dislikeCount']; $i++)
                                            <i class="far fa-thumbs-down"></i>
                                        @endfor
                                    </h6>
                                    <p class="lead">
                                    <strong>{{$generatedData['groupName']}} </strong>Grubu için üretilen restorant tavsiyesidir
                                    </p>
                                    <hr class="my-4">
                                        <p>
                                            Yeni bir tavsiye almak için grubun detay sayfasına gidebilir, üretilen restorant hakkında görüşünüzü aşağıdan belirtebilirsiniz
                                        </p>
                                        @if (empty($generatedData['isLike']))
                                            <p class="lead">
                                                <a href="{{ route('likeAction', [ 'generateId' => $generatedData['generateId'], 'isLike' => 'like' ]) }}">
                                                    <i class="far fa-thumbs-up fa-2x"></i>
                                                </a>
                                                <a style="margin-left:20px;"
                                                    href="{{ route('likeAction', [ 'generateId' => $generatedData['generateId'], 'isLike' => 'dislike' ]) }}">
                                                    <i class="far fa-thumbs-down fa-2x"></i>
                                                </a>
                                            </p>
                                        @else
                                            <span style="visibility: hidden;">
                                                {{ $generatedData['isLike'] == 'like' ? ($class = 'fa-thumbs-up') : ($class = 'fa-thumbs-down') }}
                                            </span>
                                            <p class="lead">
                                                You <i class='far {{$class}} fa-2x'></i> this generate
                                            </p>
                                        @endif
                                </div>
                            </div>
                        @endif
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
            @endif
        </div>
    </div>
</div>
@endsection
