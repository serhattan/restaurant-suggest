@extends('pages.groups')

@section('group-content')
    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">{{ $group->getName() }} - Group Details</div>
            <div class="card-body">
                <form method="POST" action="{{ route('save-settings') }}">
                    @csrf
                    <input type="hidden" name="groupId" value="{{ $group->getId() }}">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name" value="{{ $group->getName() }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="budget" class="col-md-4 col-form-label text-md-right">Budget</label>

                        <div class="col-md-6">
                            <input id="budget" type="number"
                                   class="form-control{{ $errors->has('budget') ? ' is-invalid' : '' }}"
                                   name="budget" value="{{  $group->getBudget() }}" required autofocus>

                            @if ($errors->has('budget'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('budget') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary float-right">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('pages.group.userList')
@endsection