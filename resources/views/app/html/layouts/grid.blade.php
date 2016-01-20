@extends('awesovel.app.html.index')

@section('layout')

    <div class="row card">

        <h3>{{ $operation->label }}</h3>

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
                                <th>{{ $item->label }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($collection as $_colletion)
                        <tr>
                            <td>
                                @foreach($actions->middle as $action)
                                    @include('awesovel.app.html.partials.action')
                                @endforeach
                            </td>
                            @foreach($operation->items as $item)
                                <td> {{ \Awesovel\Helpers\Parse::out($_colletion, $item->id)  }} </td>
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
