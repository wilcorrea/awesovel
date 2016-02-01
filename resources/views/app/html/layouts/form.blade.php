@extends('awesovel.app.html.index')

@section('layout')

    <script src="{{ url('ng/controller/'. $module . '/' . $entity . '/' . $operation->id. '/Controller.js') }}"></script>

    <div class="row card">

        {{--<form id="form" method="post" action="{{ awesovel_link($module, $entity) }}">--}}

        <h3>{{ $operation->label }}</h3>

        <div ng-controller="{{ $module }}Ctrl">

            @foreach($actions->top as $action)
                @include('awesovel.app.html.partials.action')
            @endforeach

            <hr>

            <formly-form form="vm.form" model="vm.data" fields="vm.fields"></formly-form>

            <hr>

            @foreach($actions->bottom as $action)
                @include('awesovel.app.html.partials.action')
            @endforeach
        </div>

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        {{--</form>--}}
    </div>

@endsection