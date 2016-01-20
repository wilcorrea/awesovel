@extends('awesovel.app.html.index')

@section('layout')

    <div class="row card">

        <form id="form" method="post" action="{{ awesovel_link($module, $entity) }}">

            <h3>{{ $operation->label }}</h3>

            @foreach($actions->top as $action)
                @include('awesovel.app.html.partials.action')
            @endforeach

            <hr>
            <div>
                {{ var_dump($operation->items) }}
            </div>
            <hr>

            @foreach($actions->bottom as $action)
                @include('awesovel.app.html.partials.action')
            @endforeach

            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        </form>
    </div>

@endsection