@extends('app')

@section('content')

    <div class="container">

        <h3>{{ $operation->title }}</h3>

        <table class="table">
            <thead>
                <tr>
                    @foreach($operation->items as $item)
                        <th>{{ $item->label }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($collection as $line)
                    <tr>
                        @foreach($operation->items as $item)
                            <td> {{ \Awesovel\Helpers\Parse::out($line, $item->id)  }} </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $collection->render() !!}
    </div>
@endsection