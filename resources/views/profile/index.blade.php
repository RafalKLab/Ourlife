@extends('templates.default')
@section('content')
{{--    <div class="row">--}}
{{--        <div class="col-lg-6">--}}
{{--            @include('user.partials.userblock')--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{ asset('images/' . $user->getAvatarUrl() ) }}" alt="Profile Photo" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4>{{$user->getNameOrUsername()}}</h4>
                                <p class="text-secondary mb-1">Full Stack Developer</p>
                                <p class="text-muted font-size-sm">
                                    @if($user->location)
                                        {{$user->location}}
                                    @endif
                                </p>
                                        @if( Auth::user()->hasFriendRequestPending($user) )
                                            <p>{{$user->getFirstNameOrUsername()}} got your requests.</p>
                                        @elseif( Auth::user()->hasFriendRequestReceived($user) )
                                            <a href="{{route('friend.accept' , ['username' => $user->username])}}" class="btn btn-primary">Accept friend request</a>
                                        @elseif( Auth::user()->isFriendWith($user) )
                                            {{$user->getFirstNameOrUsername()}} is your friend <br>
                                        <form action="{{route('friend.delete', ['username'=>$user->username])}}" method="POST">
                                            @csrf
                                            <input type="submit" class="btn btn-danger my-2" value="Unfriend">
                                        </form>
                                        @else
                                            @if($user!=Auth::user())
                                                <a href="{{ route('friend.add', ['username' => $user->username]) }}" class="btn btn-primary">Add friend</a>
                                            @endif
                                        @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$user->getNameOrUsername()}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Username</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$user->username}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$user->email}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                @if($user->location)
                                    {{$user->location}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card md-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0"><h5>{{$user->getFirstNameOrUsername()}} friends</h5></h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$user->friends()->count()}}
                            </div>
                        </div>
                        @if(!$user->friends()->count())
                            There is no friends yet!
                        @else
                            @foreach($user->friends() as $user)
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        @include('user.partials.userblock')
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

        @if($user_copy->events()->count())
                <div class="col-sm-12">
                    <h3>{{$user_copy->getFirstNameOrUsername()}} events {{ $user_copy->events()->count()  }}</h3>
                    <hr>
                </div>
            <div class="row" align="center">
                @foreach($user_copy->events()->orderBy('event_date', 'desc')->get() as $event)
                    <div class="col-lg-4 my-2">
                        <div class="card">
                            <img src="{{asset('images/' . $event->foto_path) }}" class="card-img-top" alt="EventPhoto">
                            <div class="card-body">
                                <h5 class="card-title">{{$event->title}}</h5>
                                <h6 class="card-title">{{$event->event_date}}</h6>
                                <p class="card-text">{{$event->body}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection



