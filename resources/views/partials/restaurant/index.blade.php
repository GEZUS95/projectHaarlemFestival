@extends('layout.main')
@section('content')
    <h1>Food</h1>

    @foreach($restaurant as $res)
        <a href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("restaurant_single", ["id" => $res->id])}}" class="card">
            <div class="card-body">
            <h3>{{$res->name}}</h3>
            <p>{{$res->stars}}</p>
            <p>cuisines:
                @foreach($res->types as $type)
                    {{$type->type}}
                @endforeach
            </p>
            <p>Tickets left: {{$res->seats}}</p>
            </div>
        </a>
    @endforeach

@endsection
