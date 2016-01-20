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
                            @foreach($operation->items as $item)
                                <th>{{ isset($item->label) ? $item->label : '' }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($collection as $_collection)
                        <tr>
                            <td>
                                @foreach($actions->middle as $action)
                                    @include('awesovel.app.html.partials.action')
                                @endforeach
                            </td>

                            @foreach($operation->items as $item)

                                <td> {{ awesovel_out($_collection, $item->id)  }} </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        {!! $collection->render() !!}

        <br style="clear: both" />

        @foreach($actions->bottom as $action)
            @include('awesovel.app.html.partials.action')
        @endforeach
    </div>


@endsection
