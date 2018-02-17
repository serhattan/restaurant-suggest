@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form method="POST" action="{{ route('saveRestaurant') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">Restaurant Name</label>
                        <div class="col-md-6">
                            <input id="restaurantName" type="text" class="form-control" name="restaurantName"required autofocus>
                        </div>
                        <input type="hidden" id="groupId" class="form-control" name="groupId" value={{Request::segment(3)}}>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
