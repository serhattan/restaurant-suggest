<div class="card card-default">
    <div class="card-header">Groups
        <a href="{{ route('new-group') }}" class="float-right">+</a>
    </div>
    <div class="panel list-group">
        @if(count($groupList) > 0 )
            @foreach($groupList as $group)
                <a href="#" class="list-group-item" data-toggle="collapse"
                   data-target="#group-{{ $group->getId() }}"
                   data-parent="#menu">
                    {{ $group->getName() }}
                </a>

                <div id="group-{{ $group->getId() }}" class="sublinks collapse">
                    <a href="{{ route('group-details', ['id' => $group->getId()]) }}"
                       class="list-group-item small">
                        Details
                    </a>
                    <a href="{{ route('group-restaurants', ['id' => $group->getId()]) }}" class="list-group-item small">
                        Restaurants
                    </a>
                    <a href="" class="list-group-item small">
                        History
                    </a>
                    <a href="{{ route('group-settings', ['id' => $group->getId()]) }}" class="list-group-item small">
                        Settings
                    </a>
                </div>
            @endforeach
        @else
            <span class="list-group-item">Not found group</span>
        @endif
    </div>
</div>
