@extends('layout.main')
@section('content')
    <section class="partials-restaurant-index-header">
        <h1 class="partials-restaurant-index-header-text">Haarlem Festival Food</h1>
    </section>

    @foreach($restaurant as $res)
        <a href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("restaurant_single", ["id" => $res->id])}}"
           class="partials-restaurant-index-card">
            <div class="partials-restaurant-index-card-body">
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
