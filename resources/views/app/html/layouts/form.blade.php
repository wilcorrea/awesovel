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

                @if(isset($operation->items))
                    @foreach($operation->items as $item)
                        @if(isset($item->component) && View::exists('awesovel.app.html.components.' . $item->component))
                            @include('awesovel.app.html.components.' . $item->component)
                        @endif
                    @endforeach
                @endif
            </div>
            <hr>

            @foreach($actions->bottom as $action)
                @include('awesovel.app.html.partials.action')
            @endforeach

            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        </form>
    </div>

@endsection