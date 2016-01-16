<!DOCTYPE html>
<html lang="en">
    <head>
        @include('awesovel.templates.portal.head')
    </head>

    <body>

        @include('awesovel.templates.portal.includes.nav')

        @if(isset($page) && $page->header)
            @include('awesovel.templates.portal.includes.header')
        @endif

        @yield('content')

        @include('awesovel.templates.portal.includes.footer')

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
</html>
