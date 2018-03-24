@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (empty($activityLogs))
                <div class="alert alert-danger" role="alert">
                    @lang('messages.zero_activity')!
                </div>
            @else
                <div class="card card-default" style="margin-top: 30px;">
                    <div class="card-header">@lang('messages.history')</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @foreach ($activityLogs as $activityLog)
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
