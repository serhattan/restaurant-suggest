<div class="col-md-3">
    <div class="card card-default">
        <div class="card-header">Group Members</div>
        <div class="card-body">
            @foreach($group->getUsers() as $user)
                {{ $user->getUser()->getFullName() }} <br>
            @endforeach
        </div>
    </div>
</div>