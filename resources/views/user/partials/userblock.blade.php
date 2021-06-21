<div class="media mb-2">
    <a href="{{route('profile.index', ['username' => $user->username])}}">
        <img src="{{ asset('images/' . $user->getAvatarUrl() ) }}" class="mr-3" width="60" style="border-radius: 4px;" alt="{{$user->getNameOrUsername()}}">
    </a>
    <div class="media-body">
        <h5 class="mt-0">
            <a href="{{route('profile.index', ['username' => $user->username])}}">{{$user->getNameOrUsername()}}</a>
        </h5>
        @if($user->location)
            <p>{{$user->location}}</p>
        @endif
    </div>
</div>
