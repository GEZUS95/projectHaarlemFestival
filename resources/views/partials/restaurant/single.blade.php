@extends('layout.main')
@section('content')
    <section class="partials-food-single-bg">
        <section class="partials-food-single-card">
            <h1>{{$restaurant->name}}</h1>

            {{--    TODO: logo --}}

            {{--    description     --}}
            <h2>About the restaurant</h2>
            <p>
                {{$restaurant->description}}
            </p>

            {{--    cuisines    --}}
            <h3>Cuisines of this restaurant: </h3>
            <p>
                @foreach($restaurant->types as $type)
                    {{$type->type}},
                @endforeach
            </p>

            {{--    pricing     --}}
            <h3>Pricing: </h3>
            <p>
                Regular ticket is &euro;{{$restaurant->price}}* and a Childrens Ticket (under 12 years)
                &euro;{{$restaurant->price_child}}*
            </p>
            <p class="partials-food-single-note">
                * A reservation fee of &euro;10,- per person wil be charged when a reservation is made on the Haarlem
                Festival
                site. This fee will be deducted from the final check on visiting the restaurant.
            </p>
            {{--    Sessions       --}}
            <p>
            <section class="partials-food-single-sessions">
                <h2>
                    Make a reservation
                </h2>
                <p>
                    The duration of every session is  {{gmdate('H:i', $restaurant->session_time * 60)}} hours. The restaurant gives everyday of the event the workshops at:
                </p>
                @foreach($restaurant->sessions as $count => $ses)
                    <button onclick="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order_add", ['session' => $ses])}}">
                        Session {{++$count}} <br>
                        {{date_format(date_create($ses->start_time), 'H:i')}}
                        - {{date_format(date_create($ses->end_time),'H:i')}}</button>
                @endforeach
            </section>
            </p>
        </section>
    </section>
@endsection
