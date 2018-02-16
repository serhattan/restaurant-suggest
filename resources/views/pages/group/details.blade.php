@extends('pages.groups')

@section('group-content')
    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">{{ $group->getName() }} - Group Details</div>
            <div class="card-body">
                Group Name: {{ $group->getName() }}<br>
                Budget: {{ $group->getBudget() }}
            </div>
        </div>
    </div>
    @include('pages.group.userList')
@endsection