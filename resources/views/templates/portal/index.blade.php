<!DOCTYPE html>
<html lang="en">
    <head>
        @include('awesovel.templates.portal.root.head')
    </head>

    <body>

        @include('awesovel.templates.portal.includes.nav')

        @if(isset($page) && $page->header)
            @include('awesovel.templates.portal.includes.header')
        @endif

        @yield('content')

        @include('awesovel.templates.portal.includes.footer')

        @include('awesovel.templates.portal.root.script')
    </body>
</html>
