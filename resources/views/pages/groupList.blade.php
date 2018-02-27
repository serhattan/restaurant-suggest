<div class="card card-default">
    <div class="card-header">@lang('messages.groups')
        <a href="{{ route('new-group') }}" class="float-right"><i class="fas fa-plus-circle"></i></a>
    </div>
    <div class="panel list-group group-list">
        @if(count($groupList) > 0 )
            @foreach($groupList as $group)
                <a href="#" class="list-group-item" data-toggle="collapse"
                   data-target="#group-{{ $group->getId() }}"
                   data-parent="#menu">
                    {{ $group->getName() }} <span class="badge badge-dark float-right">{{ count($group->getUsers()) }}</span>
                </a>

                <div id="group-{{ $group->getId() }}" class="sublinks collapse">
                    <a href="{{ route('group-details', ['id' => $group->getId()]) }}"
                       class="list-group-item small">
                        @lang('messages.details')
                    </a>
                    <a href="{{ route('group-members', ['id' => $group->getId()]) }}"
                       class="list-group-item small">
                        @lang('messages.members')
                    </a>
                    <a href="{{ route('group-restaurants', ['id' => $group->getId()]) }}"
                       class="list-group-item small">
                        @lang('messages.restaurant')
                    </a>
                    <a href="" class="list-group-item small">
                        @lang('messages.history')
                    </a>
                    <a href="{{ route('group-settings', ['id' => $group->getId()]) }}"
                       class="list-group-item small">
                        @lang('messages.settings')
                    </a>
                </div>
            @endforeach
        @else
            <span class="list-group-item">@lang('messages.not_found_group')</span>
        @endif
    </div>
</div>
