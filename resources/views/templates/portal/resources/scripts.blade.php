<script src="{{ awesovel_asset('bootstrap/js/bootstrap.min.js') }}"></script>

<script>
    $(function () {

        if (false) {

            var
                    $window = jQuery(window),
                    $body = jQuery('body'),
                    $top = jQuery('body > .navbar.navbar-default'),
                    platform = navigator.platform.toLowerCase();

            $window.scroll(function () {
                if ($window.scrollTop() > 75) {
                    $top.removeClass('navbar-static-top').addClass('navbar-fixed-top');
                    $body.addClass('docked');
                } else {
                    $top.removeClass('navbar-fixed-top').addClass('navbar-static-top');
                    $body.removeClass('docked');
                }
            });

            if (platform.indexOf('win') == 0 || platform.indexOf('linux') == 0) {
                if ($.browser.webkit) {
                    $.srSmoothscroll();
                }
            }

        }

    });
</script>