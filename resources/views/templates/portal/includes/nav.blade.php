
<nav class="navbar navbar-default {{ (awesovel_environment() !== awesovel_config('app')) ? 'navbar-static-top' : 'navbar-fixed-top' }}">

    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle Navigation</span>
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
                <i class="material-icons collapse-button">menu</i>
            </button>

            @if(awesovel_environment() === awesovel_config('app'))
                <a class="navbar-brand font-play" href="{{ awesovel_route('home') }}"> {{ awesovel_config('name') }} </a>
            @endif
        </div>

        <div class="collapse navbar-collapse navbar-collapse-top" id="navbar">

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
                    <li>
                        <a href="{{ awesovel_route('app/main/concourse/my-concourse') }}">Meus Concursos</a>
                    </li>
                    <li class="hidden-xs"><a> | </a></li>
                    <li class="dropdown">
                        <a href="." class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ auth()->user()->email }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ awesovel_route('app') }}"> <i class="material-icons">home</i> Área Administrativa</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ awesovel_route('app/main/concourse/my-concourse') }}"> <i class="material-icons">payment</i> Meus Concursos</a>
                            </li>
                            <li>
                                <a href="{{ awesovel_route('app/main/concourse/billet') }}"> <i class="material-icons">attach_money</i> Segunda Via</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ awesovel_route('auth/logout') }}"> <i class="material-icons">power_settings_new</i> Sair</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>

        </div>
    </div>
</nav>