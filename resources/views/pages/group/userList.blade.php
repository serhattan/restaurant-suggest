@extends('pages.groups')

@section('group-content')
    <div class="col-md-9">
        <div class="card card-default">
            <div class="card-header">@lang('messages.new_members')</div>
            <div class="card-body">
                <form method="POST" action="{{ route('new-member') }}">
                    @csrf
                    <input type="hidden" name="groupId" value="{{ $group->getId() }}">
                    <div class="input-group">
                        <input type="email" name="email" class="form-control"
                               placeholder="@lang('messages.please_enter_email')">
                        <span class="input-group-addon">&nbsp;</span>
                        <button class="btn btn-primary bg-dark border-dark">@lang('messages.add_new_members')</button>
                    </div>
                </form>
            </div>
        </div><br>
        <div class="card card-default">
            <div class="card-header">@lang('messages.group_members')</div>
            <div class="card-body">
                @foreach($group->getUsers() as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $user->getUser()->getFullName() }}
                        <a href="{{ route('group-member-delete', ['userId' => $user->getUserId(), 'groupId' => $group->getId() ]) }}"><i
                                    class="fas fa-times-circle"></i></a>
                    </li>
                @endforeach
            </div>
        </div>
    </div>
@endsection
