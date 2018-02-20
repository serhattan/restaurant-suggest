@extends('layouts.app')

@section('content')
    <div class="container">
        @if(isset($status))
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @if($status)
                        <div class="alert alert-success" role="alert">
                            <strong>@lang('messages.well_done')!</strong> {{ $message }}
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                            <strong>@lang('messages.oh_snap')!</strong> {{ $message }}
                        </div>
                    @endif
                </div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="{{ isset($group) ? 'col-md-3' : 'col-md-12' }}">
                @include('pages.groupList')
            </div>

            @if (isset($group))
                @yield('group-content')
            @endif
        </div>
    </div>
@endsection
