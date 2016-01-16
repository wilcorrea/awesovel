@extends('app')

@section('content')

    <section class="container-fluid">
        <div class="row">

            <div class="col-sm-2">

                @include('awesovel.app.html.partials.sidebar')

            </div>

            <div class="col-sm-10">

                <div class="row card">
                    <h3>{{ $operation->label }}</h3>

                    @foreach($actions->top as $button)
                        @include('awesovel.app.html.partials.button')
                    @endforeach

                    {{ var_dump($collection) }}

                    @foreach($actions->bottom as $button)
                        @include('awesovel.app.html.partials.button')
                    @endforeach
                </div>

            </div>

        </div>
    </section>

@endsection