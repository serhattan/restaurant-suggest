<div class="col-md-3">
    <div class="card card-default">
        <div class="card-header">@lang('messages.group_members')</div>
        <div class="card-body">
            @foreach($group->getUsers() as $user)
                {{ $user->getUser()->getFullName() }}  <br>
            @endforeach
        </div>
    </div>
    <br>
    <div class="card card-default">
        <div class="card-header">@lang('messages.new_members')</div>
        <div class="card-body">
            <form method="POST" action="{{ route('new-member') }}">
                @csrf
                <input type="hidden" name="groupId" value="{{ $group->getId() }}">
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="@lang('messages.please_enter_email')">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary float-right">@lang('messages.add_new_members')</button>
                </div>
            </form>
        </div>
    </div>
</div>