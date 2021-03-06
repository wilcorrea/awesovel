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
                                            @foreach($actions->middle as $button)
                                                @include('awesovel.app.html.partials.button')
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

                    @include('awesovel.app.html.partials.pagination')

                    <br style="clear: both" />

                    @foreach($actions->bottom as $button)
                        @include('awesovel.app.html.partials.button')
                    @endforeach
                </div>

            </div>

        </div>
    </section>

@endsection
