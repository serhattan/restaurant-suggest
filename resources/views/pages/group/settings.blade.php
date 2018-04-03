@extends('pages.groups')

@section('group-content')
    <div class="col-md-9">
        <div class="card card-default">
            <div class="card-header">{{ $group->getName() }} - @lang('messages.group_settings')</div>
            <div class="card-body">
                <form method="POST" action="{{ route('save-settings') }}">
                    @csrf
                    <input type="hidden" name="groupId" value="{{ $group->getId() }}">
                    <div class="form-group">
                        <label for="name">@lang('messages.name')</label>
                        <input id="name" type="text"
                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="{{ $group->getName() }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="budget">@lang('messages.budget')</label>
                        <input id="budget" type="number"
                               class="form-control{{ $errors->has('budget') ? ' is-invalid' : '' }}"
                               name="budget" value="{{  $group->getBudget() }}" required autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary bg-dark border-dark"> @lang('messages.save_changes')</button>
                    <a href="{{ route('group-delete', ['id' => $group->getId()]) }}"
                       class="btn btn-danger text-white float-right">
                        @lang('messages.delete_group')
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection