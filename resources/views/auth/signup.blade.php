@extends('templates.default')
@section('content')
    <div class="row">
        <div class="col-lg-4 mx-auto">
            <h3>Registration!</h3>
            <form method="POST" action="{{route('auth.signup')}}" novalidate>
                @csrf
                <div class="form-group">
                    <label for="InputEmail">Email address</label>
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="InputEmail" name='email' aria-describedby="emailHelp" placeholder="Enter email"
                           value="{{Request::old('email') ? : ''}}">
                    @if ($errors->has('email'))
                        <span class="help-block text-danger">
                            {{ $errors->first('email')}}
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="InputUsername">Username</label>
                    <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="InputUsername" name='username'placeholder="Enter username"
                           value="{{Request::old('username') ? : ''}}">
                    @if ($errors->has('username'))
                        <span class="help-block text-danger">
                            {{ $errors->first('username')}}
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="InputPassword">Password</label>
                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="InputPassword" name='password' placeholder="Enter password">
                    @if ($errors->has('password'))
                        <span class="help-block text-danger">
                            {{ $errors->first('password')}}
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
@endsection
