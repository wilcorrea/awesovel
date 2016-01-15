@extends('app')

@section('content')

    <div class="container">

        <h3>{{ $operation->label }}</h3>

        @foreach($actions->top as $button)
            @include('awesovel.html.partials.button')
        @endforeach

        {{ var_dump($collection) }}

        @foreach($actions->bottom as $button)
            @include('awesovel.html.partials.button')
        @endforeach

    </div>
@endsection