@extends('awesovel.app')

@section('content')

    @if(isset($page->banner) && $page->banner)

        <div class="container--banner">
            <div class="container">
                <div class="container--banner-message">
                    <p>Conectamos os melhores talentos com as instituições de mais alta qualidade e eficiência</p>
                </div>
            </div>
        </div>

    @endif

    <div class="container main-container">

        @yield('main-container')

    </div>

@endsection