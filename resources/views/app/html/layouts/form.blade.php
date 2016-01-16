@extends('app')

@section('content')

    <section class="body container">
        <h3>{{ $operation->label }}</h3>

        @foreach($actions->top as $button)
            @include('awesovel.app.html.partials.button')
        @endforeach

        {{ var_dump($collection) }}

        @foreach($actions->bottom as $button)
            @include('awesovel.app.html.partials.button')
        @endforeach
    </section>

@endsection