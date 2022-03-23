@extends('layout.main')
@section('content')
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
        * A reservation fee of &euro;10,- per person wil be charged when a reservation is made on the Haarlem Festival
        site. This fee will be deducted from the final check on visiting the restaurant.
    </p>
{{--    Sessions       --}}
    <p>

            <section>
                {{$restaurant->sessions->start_time}}
{{--                Session {{$ses->number}}--}}
{{--                {{$ses->start_time}} - {{$ses->end_time}}--}}
            </section>

    </p>
@endsection
