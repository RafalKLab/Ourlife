@extends('templates.default')
@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h3>Edit profile!</h3>
            <form method="POST" enctype="multipart/form-data" action="{{route('profile.edit')}}" novalidate>
                @csrf
                <div class="form-group">
                    <label for="InputFirtsName">First name</label>
                    <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="InputFirtsName" name='first_name'
                           value="{{Request::old('first_name') ?: Auth::user()->first_name}}">
                    @if ($errors->has('first_name'))
                        <span class="help-block text-danger">
                            {{ $errors->first('first_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="InputLastName">Last name</label>
                    <input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="InputLastName" name='last_name'
                           value="{{Request::old('last_name') ?: Auth::user()->last_name}}">
                    @if ($errors->has('last_name'))
                        <span class="help-block text-danger">
                            {{ $errors->first('last_name')}}
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="InputLocation">Location Address</label>
                    <input type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" id="InputLocation" name='location'
                           value="{{Request::old('location') ?: Auth::user()->location}}">
                    @if ($errors->has('location'))
                        <span class="help-block text-danger">
                            {{ $errors->first('location')}}
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="title">Profile photo</label>
                    <input type="file" name="photo" class="form-control" placeholder="Select photo">
{{--                    @if ($errors->has('photo'))--}}
{{--                        <span class="help-block text-danger">--}}
{{--                            {{ $errors->first('photo')}}--}}
{{--                </span>--}}
{{--                    @endif--}}
{{--                    {{ $errors->has('photo') ? ' is-invalid' : '' }}--}}
                </div>

                <button type="submit" class="btn btn-primary">Edit profile</button>
            </form>
        </div>
    </div>
@endsection
