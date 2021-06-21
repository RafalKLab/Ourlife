<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{route('Admin')}}">{{config('app.name')}} <small>Admin panel</small></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if (Auth::check())
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('admin/users') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('Admin.users')}}">Users</a>
                </li>
                <li class="nav-item {{ Request::is('admin/roles') ? 'active' : '' }}">
                    <a class="nav-link " href="{{route('Admin.roles')}}">Roles</a>
                </li>
                <li class="nav-item {{ Request::is('admin/posts') ? 'active' : '' }}">
                    <a class="nav-link " href="{{route('Admin.posts')}}">Posts</a>
                </li>

            </ul>
            @endif
            <ul class="navbar-nav ml-auto">
                @if (Auth::check())
                    <li class="nav-item {{ Request::is('user/' . Auth::user()->username) ? 'active' : '' }}">
                        <a href="{{route('profile.index', ['username' => Auth::user()->username])}}"
                           class="nav-link">{{Auth::user()->getNameOrUsername()}}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('home')}}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('auth.signout')}}" class="nav-link">Logout</a>
                    </li>

                @else
                    <li class="nav-item {{ Request::is('signup') ? 'active' : '' }}">
                        <a href="{{route('auth.signup')}}" class="nav-link">Sign up</a>
                    </li>
                    <li class="nav-item {{ Request::is('signin') ? 'active' : '' }}">
                        <a href="{{route('auth.signin')}}" class="nav-link">Sign in</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
