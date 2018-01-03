<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            @admin
                <a class="navbar-brand" href="{{ route('adminposts.index') }}">
                    <span class="inspirational-brand">Inspirational</span> Blog
                    <span class="badge">Admin Area</span>
                </a>
            @else
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="inspirational-brand">Inspirational</span> Blog
                </a>
            @endadmin
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @guest
                    <li><a href="{{ route('posts.index') }}">All Posts</a></li>
                @endguest
                @member
                    <li><a href="{{ route('posts.index') }}">All Posts</a></li>
                    <li><a href="{{ route('posts.index', ['myposts' => 1]) }}">My Posts</a></li>
                    <li><a href="{{ route('posts.create') }}">Create Post</a></li>
                @endmember
                @admin
                    <li><a href="{{ route('adminposts.index') }}">All Posts</a></li>
                    <li><a href="{{ route('adminposts.index', ['published' => 0]) }}">Unpublished Posts</a></li>
                    <li><a href="{{ route('adminposts.index', ['published' => 1]) }}">Published Posts</a></li>
                @endadmin
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>