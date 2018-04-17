@extends('layouts.app')

@section('content')
    @if (empty($activityLogs))
        <div class="c-box c-box-large u-gap-bottom">
            <div class="c-box_body row bold">
                @lang('messages.zero_activity')!
            </div>
        </div>
    @else
        <div class="c-box c-box-large u-gap-bottom">
            <div class="c-box_body">
                <h3 class="u-clear-gap-top">@lang('messages.history')</h3>
                <ul class="c-timeline">
                    @foreach ($activityLogs as $activityLog)
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
    @endif
@endsection
