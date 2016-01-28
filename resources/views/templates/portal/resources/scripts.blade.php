<script src="{{ awesovel_asset('bootstrap/js/bootstrap.min.js') }}"></script>

<script>
    jQuery(function () {

        var
            $window = jQuery(window),
            $body = jQuery('body'),
            $top = jQuery('body > .navbar.navbar-default'),
            platform = navigator.platform.toLowerCase();

        @if(awesovel_environment() !== awesovel_config('app'))

            $window.scroll(function () {
                if ($window.scrollTop() > 75) {
                    $top.removeClass('navbar-static-top').addClass('navbar-fixed-top');
                    $body.addClass('docked');
                } else {
                    $top.removeClass('navbar-fixed-top').addClass('navbar-static-top');
                    $body.removeClass('docked');
                }
            });

        @endif

        if (platform.indexOf('win') == 0 || platform.indexOf('linux') == 0) {
            if ($.browser.webkit) {
                //$.srSmoothscroll();
            }
        }

    });
</script>