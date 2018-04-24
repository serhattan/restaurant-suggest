@extends('layouts.app')


@section('content-top')
    @include('layouts.newGroupBar')
@endsection
@section('content')
    <div class="container">
        @include('pages.groupList')
    </div>
@endsection
