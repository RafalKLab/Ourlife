@extends('templates.default')
@section('content')
   <div class="row">
       <div class="col-lg-6">
           <form action="{{route('status.post')}}" method="POST">
               @csrf
               <div class="form-group">
                   <textarea name="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" placeholder="How are you {{ Auth::user()->getFirstNameOrUsername() }} ?" rows="3"></textarea>
               @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
               @endif
               </div>
               <button type="submit" class="btn btn-primary">Post</button>
           </form>
       </div>
   </div>

    <div class="row">
        <div class="col-lg-6">
            <hr>

            @if( ! $statuses->count() )
                <p>There is no posts in timeline yet!</p>
            @else
                @foreach($statuses as $status)
                    <div class="media">
                        <a href="{{ route('profile.index', ['username' => $status->user->username]) }}" class="mr-3">
                            <img class="media-object rounded" width="50px" src="{{ asset('images/' . $status->user->getAvatarUrl())}}" alt="{{ $status->user->getNameOrUsername() }}" >
                        </a>
                        <div class="media-body">
                            <h4>
                                <a href="{{ route('profile.index', ['username' => $status->user->username]) }}">{{ $status->user->getNameOrUsername() }}</a>
                            </h4>
                                <p>{{ $status->body }}</p>
                                <ul class="list-inline">
                                    <li class="list-inline-item">{{ $status->created_at->diffForHumans() }}</li>
                                    @if($status->user->id !== Auth::user()->id)
                                        <li class="list-inline-item">
                                            <a href="{{route('status.like', ['statusId' => $status->id])}}">Like</a>
                                        </li>
                                    @endif
                                    <li class="list-inline-item">
                                        {{$status->likes->count()}} {{Str::plural('like',$status->likes->count())}}
                                    </li>
                                </ul>

                            @foreach($status->replies as $reply)
                                <div class="media">
                                    <a href="{{ route('profile.index', ['username' => $reply->user->username]) }}" class="mr-3">
                                        <img class="media-object rounded" width="50px" src="{{ asset('images/' . $reply->user->getAvatarUrl())}}" alt="{{ $reply->user->getNameOrUsername() }}" >
                                    </a>
                                    <div class="media-body">
                                        <h6>
                                            <a href="{{ route('profile.index', ['username' => $reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a>
                                        </h6>
                                        <p>{{ $reply->body }}</p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">{{ $reply->created_at->diffForHumans() }}</li>
                                            @if($reply->user->id !== Auth::user()->id)
                                                <li class="list-inline-item">
                                                    <a href="{{route('status.like', ['statusId' => $reply->id])}}">Like</a>
                                                </li>
                                            @endif
                                            <li class="list-inline-item">
                                                {{$reply->likes->count()}} {{Str::plural('like',$reply->likes->count())}}
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            @endforeach

                                <form action="{{route('status.reply', ['statusId'=> $status->id])}}" method="POST" class="mb-2">
                                    @csrf
                                    <div class="form-group">
                                        <textarea name="reply-{{ $status->id }}" class="form-control{{ $errors->has("reply-{$status->id}") ? ' is-invalid' : '' }}" placeholder="Write a comment" rows="3"></textarea>
                                        @if($errors->has("reply-{$status->id}"))
                                            <div class="invalid-feedback">
                                                {{ $errors->first("reply-{$status->id}") }}
                                            </div>
                                        @endif
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Reply">
                                </form>

                            @if( Auth::user()->id == $status->user_id)
                                <form class="mb-3" action="{{ route('status.destroy', ['id' => $status->id]) }}" method="POST">
                                    @csrf
                                    <input type="submit" class="btn btn-danger" value="Delete post">
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach

                {{ $statuses->links('pagination::bootstrap-4') }}
            @endif
        </div>
    </div>
@endsection
