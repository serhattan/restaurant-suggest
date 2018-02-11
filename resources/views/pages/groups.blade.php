@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card card-default">
                    <div class="card-header">Groups</div>
                    <div class="panel list-group">
                        @if(count($groups) > 0 )
                            @foreach($groups as $group)
                                <a href="#" class="list-group-item" data-toggle="collapse"
                                   data-target="#group-{{ $group->getId() }}"
                                   data-parent="#menu">
                                    {{ $group->getName() }}
                                </a>
                                <div id="group-{{ $group->getId() }}" class="sublinks collapse">
                                    <a href="" class="list-group-item small">
                                        Details
                                    </a>
                                    <a href="" class="list-group-item small">
                                        Members
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <span class="list-group-item">Not found group</span>
                        @endif

                        <a href="#" class="list-group-item">New Group<span
                                    class="glyphicon glyphicon-stats pull-right"></span></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header">Group Details</div>

                    <div class="card-body">
                        @if(!empty($firstGroup))
                            Group Name:  {{ $firstGroup->getName() }}<br>
                            Budget: {{ $firstGroup->getBudget() }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-default">
                    <div class="card-header">Group Members</div>

                    <div class="card-body">
                        @if(!empty($firstGroup))
                            @foreach($firstGroup->getUsers() as $user)
                                {{ $user->getUser()->getFullName() }} <br>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
