@extends('layout.main')
@section('content')
    <h1>Restaurant</h1>

    {{$restaurant->name}}

    @foreach($restaurant->types as $type)
        <br> type: {{$type->type}}
    @endforeach

@endsection
