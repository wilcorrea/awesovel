<ul class="nav navbar-nav">

    <li>
        <a href="{{ awesovel_route('app') }}">App</a>
    </li>
    <li class="dropdown">

        <a href="." class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Dropdown <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href=".">Action</a>
            </li>
            <li>
                <a href=".">Another action</a>
            </li>
            <li>
                <a href=".">Something else here</a>
            </li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header">Nav header</li>
            <li>
                <a href=".">Separated link</a>
            </li>
            <li>
                <a href=".">One more separated link</a>
            </li>
        </ul>

    </li>
</ul>

<ul class="nav navbar-nav navbar-right">
    @if(auth()->guest())
        @if(!Request::is('auth/login'))
            <li><a href="{{ awesovel_route('auth/login') }}">Login</a></li>
        @endif
        @if(!Request::is('auth/login') && !Request::is('auth/register'))
            <li class="hidden-xs"><a> | </a></li>
        @endif
        @if(!Request::is('auth/register'))
            <li><a href="{{ awesovel_route('auth/register') }}">Register</a></li>
        @endif
    @else
        <li class="dropdown">
            <a href="." class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ auth()->user()->email }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="{{ awesovel_route('auth/logout') }}">Logout</a>
                </li>
            </ul>
        </li>
    @endif
</ul>