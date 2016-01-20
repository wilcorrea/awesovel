<ul class="nav navbar-nav">

    @if(isset($page->menu) && is_array($page->menu))

        @foreach($page->menu as $menu)
            <li>
                <a href="{{ awesovel_route($menu->href) }}">{{ $menu->label }}</a>
            </li>
        @endforeach

    @endif
</ul>

<ul class="nav navbar-nav navbar-right">

    @if(auth()->guest())

        @if(!Request::is('auth/login'))
            <li>
                <a href="{{ awesovel_route('auth/login') }}">Entrar</a>
            </li>
        @endif

        @if(!Request::is('auth/login') && !Request::is('auth/register'))
            <li class="hidden-xs"><a> | </a></li>
        @endif

        @if(!Request::is('auth/register'))
            <li>
                <a href="{{ awesovel_route('auth/register') }}">Cadastrar</a>
            </li>
        @endif

    @else
        <li class="dropdown">
            <a href="." class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ auth()->user()->email }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="{{ awesovel_route('auth/logout') }}">Sair</a>
                </li>
            </ul>
        </li>
    @endif
</ul>