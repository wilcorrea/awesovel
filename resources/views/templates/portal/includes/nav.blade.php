<nav class="navbar navbar-default navbar-static-top">

    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ go('home') }}">!Brand!</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar">

            <ul class="nav navbar-nav">
                <li><a href="{{ go('app') }}">App</a></li>
                <li><a href="{{ go('about') }}">About</a></li>
                <li><a href="{{ go('contact') }}">Contact</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(auth()->guest())
                    @if(!Request::is('auth/login'))
                        <li><a href="{{ go('/auth/login') }}">Login</a></li>
                    @endif
                    @if(!Request::is('auth/register'))
                        <li><a href="{{ go('/auth/register') }}">Register</a></li>
                    @endif
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">{{ auth()->user()->email }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ go('/auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>