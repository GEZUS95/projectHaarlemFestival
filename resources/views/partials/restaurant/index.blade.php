@extends('layout.main')
@section('content')
    <h1>Food</h1>

    @foreach($restaurant as $restaurant)
        <div>{{$restaurant}}</div>
    @endforeach

@endsection
