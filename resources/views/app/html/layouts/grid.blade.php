@extends('awesovel.app.html.index')

@section('layout')

    <div class="row card">


{{--{{ dd($operation) }}--}}

        <h3>{{ isset($operation->label) ? $operation->label : '' }}</h3>

        @foreach($actions->top as $action)
            @include('awesovel.app.html.partials.action')
        @endforeach

        <br><br>

        <div style="width: 100%; overflow-x: auto; overflow-y: auto">

            <div style="min-width: 500px;">

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>{{ "Opções" }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <br style="clear: both" />

        @foreach($actions->bottom as $action)
            @include('awesovel.app.html.partials.action')
        @endforeach
    </div>


@endsection
