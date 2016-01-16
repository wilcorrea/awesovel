@extends('app')

@section('content')

    <h3>{{ config('awesovel')['name'] }}</h3>

    <p>
        {{ \Awesovel\Helpers\Json::encode(config('awesovel')) }}
    </p>
@endsection