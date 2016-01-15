@extends('app')

@section('content')
    <div class="container">
        <h3>{{ $operation->title }}</h3>
        <div class="jumbotron">
            <table class="table">
                <thead>
                <th></th>
                </thead>
            </table>
            @foreach($data as $value)
                <p>{{ $value }}</p>
            @endforeach
        </div>
    </div>
@endsection