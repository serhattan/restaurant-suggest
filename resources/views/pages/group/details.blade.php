@extends('pages.groups')

@section('group-content')
    <div class="col-md-9">
        <div class="card card-default">
            <div class="card-header">{{ $group->getName() }} - @lang('messages.group_details')</div>
            <div class="card-body">
                <a href="{{route('generate', ['groupId' => $group->getId()])}}" class="btn btn-success">Generate</a>
                @if(isset($generate))
                    <li class="list-group-item">
                        <i class="fas fa-money-bill-alt"></i> {{$generate->getRestaurant()->getName()}}
                    </li>
                @endif
                <li class="list-group-item">
                    <i class="fas fa-money-bill-alt"></i> @lang('messages.budget')
                    - {{ $group->getBudget() }}@lang('messages.currency_icon')
                </li>
                <li class="list-group-item">
                    <i class="fas fa-users"></i> @lang('messages.members_count') - {{ count($group->getUsers()) }}
                </li>
            </div>
        </div>
    </div>
@endsection