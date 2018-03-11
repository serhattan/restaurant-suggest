@extends('pages.groups')

@section('group-content')
    <div class="col-md-9">
        <div class="card card-default">
            <div class="card-header">
                {{ $group->getName() }} - @lang('messages.history')
            </div>
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
    </div>
@endsection
