@extends('awesovel.app')

@section('content')

    <section class="app container-fluid">

        <div class="col-sm-2">

            @include('awesovel.app.html.partials.sidebar')

        </div>

        <div class="col-sm-10">

            @yield('layout')

        </div>

    </section>

@endsection