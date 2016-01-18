<nav class="navbar navbar-default navbar-fixed-top">

    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle Navigation</span>
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
                <i class="material-icons collapse-button">menu</i>
            </button>

            <a class="navbar-brand font-roboto" href="{{ awesovel_route('home') }}"> {{ config('awesovel')['brand'] }} </a>
        </div>

        <div class="collapse navbar-collapse navbar-collapse-top" id="navbar">

            @include('awesovel.templates.portal.includes.menu-top')

        </div>
    </div>
</nav>