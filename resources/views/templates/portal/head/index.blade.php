<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">


<title>{{ config('awesovel')['name'] }}</title>

<!-- Google Fonts -->
{{--https://design.google.com/icons/--}}
<link href="{{ awesovel_asset('google-fonts/roboto/index.css') }}" rel="stylesheet">
<link href="{{ awesovel_asset('google-fonts/material-icons/index.css') }}" rel="stylesheet">
<link href="{{ awesovel_asset('google-fonts/audiowide/index.css') }}" rel="stylesheet">
<link href="{{ awesovel_asset('google-fonts/play/index.css') }}" rel="stylesheet">

<!-- Bootstrap -->
{{--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">--}}
<link href="{{ awesovel_asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ awesovel_asset('bootstrap/css/sticky-footer-fixed.css') }}" rel="stylesheet">
<link href="{{ awesovel_asset('bootstrap/css/index.css') }}" rel="stylesheet">

@include(config('awesovel')['theme'])

<!-- Font Awesome -->
<link href="{{ awesovel_asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

<!-- JQuery -->
<script src="{{ awesovel_asset('jquery/jquery.min.js') }}"></script>

<link href="{{ awesovel_asset('@/css/index.css') }}" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=1">