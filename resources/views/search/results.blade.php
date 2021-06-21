@extends('templates.default')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h3>Search results: "{{Request::input('query')}}"</h3>
            @if(!$users->count())
                <p>Users not found!</p>
            @else
                    <div class="row">
                        <div class="col-lg-6">
                            @foreach($users as $user)
                                 @include('user.partials.userblock')
                            @endforeach
                        </div>
                    </div>
            @endif
        </div>
    </div>
@endsection
