@extends('layouts.app')

@section('content')
    <div class="c-box c-box-medium">
        <div class="c-box_body">
            <h1 class="h2">@lang('messages.home')</h1>

            @if (empty($activityLogGroups) && empty($generatedDatas))
                <div class="alert alert-danger" role="alert">
                    @lang('messages.zero_activity')!
                </div>
            @else
                @foreach ($generatedDatas as $generatedData)
                    <div class="row">
                        <div class="col col-md-4">
                            <img src="{{ asset('img/generate.png') }}" class="u-img-responsive"
                                 style="margin-bottom: 0 !important;">
                        </div>
                        <div class="col col-md-8 u-gap-bottom-medium u-flex u-flex-dir-column">
                            <div class="c-box c-box-small u-flex-grow-full">
                                <div class="c-box_body">
                                    <div class="c-user-card u-gap-bottom-small">
                                        <a class="c-user-card_image" href="">
                                            <i class="fas fa-building fa-4x"></i>
                                        </a>
                                        <div class="c-user-card_body">
                                            <a href="{{ route('group-details', ['id' => $generatedData['groupId']]) }}"
                                               class="c-user-card_title"> {{$generatedData['generatedRestaurant']}}
                                            </a>
                                            <span class="c-user-card_subtitle">
                                                <strong>
                                                    @lang('messages.generate_restaurant_title', ['groupName' => $generatedData['groupName']])
                                                </strong>
                                            </span>
                                        </div>
                                    </div>
                                    <p class="u-clear-gap">
                                        @for ($i = 0; $i < $generatedData['likeCount']; $i++)
                                            <i class="far fa-thumbs-up"></i>
                                        @endfor
                                        @for ($i = 0; $i < $generatedData['dislikeCount']; $i++)
                                            <i class="far fa-thumbs-down"></i>
                                        @endfor
                                    </p>
                                    <small class="u-clear-gap">
                                        @lang('messages.generated_restaurant_paragraph')
                                    </small>
                                </div>

                                <div class="c-box_footer col-md-8">
                                    @if (empty($generatedData['isLike']))
                                        <a href="{{ route('likeAction', [ 'generateId' => $generatedData['generateId'], 'isLike' => 'like' ]) }}">
                                            <i class="far fa-thumbs-up"></i>
                                        </a>
                                        <a href="{{ route('likeAction', [ 'generateId' => $generatedData['generateId'], 'isLike' => 'dislike' ]) }}">
                                            <i class="far fa-thumbs-down"></i>
                                        </a>
                                    @else
                                        <p>
                                            You
                                            <i class='far {{$generatedData['isLike'] == 'like' ? 'fa-thumbs-up' : 'fa-thumbs-down'}} fa-2x'></i>
                                            this generate
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="c-box c-box-large u-gap-bottom">
                        <div class="c-box_body">
                            <h3 class="u-clear-gap-top">@lang('messages.history')</h3>
                            <ul class="c-timeline">
                                @foreach ($activityLogGroups as $activityLog)
                                    <li class="c-timeline_item">
                                        <h5 class="c-timeline_title u-clear-gap">
                                            @lang("messages.".$activityLog->getActivity()->getName(). "_". $activityLog->getActivity()->getTable())
                                        </h5>
                                        <p class="u-clear-gap">@lang("messages.".$activityLog->getActivity()->getTable(). "_". $activityLog->getActivity()->getName(),
                                            $activityLog->getContent())</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
