@extends('templates.default')
@section('content')
    <div class="row">
        <div class="col-sm-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Your friends: {{$friends->count()}}</h5>
                    @if(!$friends->count())
                        <hr>
                        There is no friends yet!
                    @else
                        @foreach($friends as $user)
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    @include('user.partials.userblock')
                                </div>
                                <div class="col-sm-8 text-secondary">
                                    Example text
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Your friend requests: {{$requests->count()}}</h5>
                    @if(!$requests->count())
                        <hr>
                        You have no friends requests yet!
                    @else
                        @foreach($requests as $user)
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    @include('user.partials.userblock')
                                </div>
                                <div class="col-sm-6 text-secondary" align="center">
                                    @if( Auth::user()->hasFriendRequestReceived($user) )
                                        <a href="{{route('friend.accept' , ['username' => $user->username])}}" class="btn btn-primary">Accept</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
