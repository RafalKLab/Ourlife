@extends('templates.default')
@section('content')
    <div class="row">
        <div class="col-lg-4 mx-auto">
            <h3>Log in to your account!</h3>
            <form method="POST" action="{{route('auth.signin')}}" novalidate>
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
                    <label for="InputPassword">Password</label>
                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="InputPassword" name='password' placeholder="Enter password">
                    @if ($errors->has('password'))
                        <span class="help-block text-danger">
                            {{ $errors->first('password')}}
                        </span>
                    @endif
                </div>
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                    <label class="custom-control-label" for="remember">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary">Log in</button>
            </form>
        </div>
    </div>
@endsection
