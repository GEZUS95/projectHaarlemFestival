@extends('layout.main')
@section('content')

    <style>


    </style>

    <div class="partials-home">
        <div class="partials-home-image-container">
            <img src="{{\Matrix\Managers\RouteManager::getUrlByRouteName("assets", ["slug" => "banner.jpg"])}}"
                 alt="haarlem"
                 class="partials-home-image"
            >

            <div class="partials-home-image-title">Haarlem Festival</div>
            <div class="partials-home-image-search">
                <div class="partials-home-image-search-bar">
                    <div class="partials-home-image-search-bar-border">
                        Search
                    </div>
                </div>
            </div>
        </div>

        <div class="partials-home-welcome">
            <div class="partials-home-welcome-title">Welcome to haarlem</div>
            <div class="partials-home-welcome-text"> Haarlem is a city that has its roots even before the medieval
                period, with so much history there is much to explore! Haarlem has a beautiful city centre with shops,
                restaurants and museums. The Grote Markt, which is next to the famous Grote Kerk, is a hub for many fun
                activies like jazz, dance and there are of course many nice restaurants for a quick snack. When visiting
                Haarlem, there is no room for boredom! Be surprised by the many sights and places to visit, the Haarlem
                Festival is just the beginning of your trip to this beautiful city!
            </div>
            <div class="partials-home-welcome-text-bold"> Consult the website of the relevant Haarlem location for
                up-to-date information about the measures taken. If you want to orientate yourself for a visit to
                Haarlem, check out the various tips and options on this website.
            </div>
        </div>

        <div class="partials-home-grid-wrapper">
            <div class="partials-home-grid">
                <div class="partials-home-grid-update partials-home-grid-holder">
                    <img src="{{\Matrix\Managers\RouteManager::getUrlByRouteName("assets", ["slug" => "update.jpg"])}}"
                         alt="haarlem"
                         class="partials-home-grid-images"
                    >
                    <div class="partials-home-grid-text">Carona virus updates</div>
                </div>
                <div class="partials-home-grid-museum partials-home-grid-holder">
                    <img src="{{\Matrix\Managers\RouteManager::getUrlByRouteName("assets", ["slug" => "museums.jpg"])}}"
                         alt="haarlem"
                         class="partials-home-grid-images"
                    >
                    <div class="partials-home-grid-text">Museums</div>
                </div>
                <div class="partials-home-grid-food partials-home-grid-holder">
                    <img src="{{\Matrix\Managers\RouteManager::getUrlByRouteName("assets", ["slug" => "food.jpg"])}}"
                         alt="haarlem"
                         class="partials-home-grid-images"
                    >
                    <div class="partials-home-grid-text">Restaurant</div>
                </div>
                <div class="partials-home-grid-jazz partials-home-grid-holder">
                    <img src="{{\Matrix\Managers\RouteManager::getUrlByRouteName("assets", ["slug" => "jazz.jpg"])}}"
                         alt="haarlem"
                         class="partials-home-grid-images"
                    >
                    <div class="partials-home-grid-text">Jazz event</div>
                </div>
                <div class="partials-home-grid-must partials-home-grid-holder">
                    <img src="{{\Matrix\Managers\RouteManager::getUrlByRouteName("assets", ["slug" => "must.jpg"])}}"
                         alt="haarlem"
                         class="partials-home-grid-images"
                    >
                    <div class="partials-home-grid-text">Must Sees</div>
                </div>
                <div class="partials-home-grid-shop partials-home-grid-holder">
                    <img src="{{\Matrix\Managers\RouteManager::getUrlByRouteName("assets", ["slug" => "shop.jpg"])}}"
                         alt="haarlem"
                         class="partials-home-grid-images"
                    >
                    <div class="partials-home-grid-text">Your shopping moment</div>
                </div>
                <div class="partials-home-grid-dance partials-home-grid-holder">
                    <img src="{{\Matrix\Managers\RouteManager::getUrlByRouteName("assets", ["slug" => "dance.jpg"])}}"
                         alt="haarlem"
                         class="partials-home-grid-images"
                    >
                    <div class="partials-home-grid-text">Dance Event</div>
                </div>
            </div>
        </div>

        <div class="partials-home-welcome">
            <div class="partials-home-welcome-title">A day trip to Haarlem Festival and surroundings</div>
            <div class="partials-home-welcome-text"> Jazz is an old music genre that consists of many subgenres due to
                its age. Most people have different feelings of what is jazz and what is not because of this. This is
                what makes jazz very fun for both young and old! At the Haarlem festival there will be 18 bands playing
                across 4 different days, on thursday, friday and saturday the concerts will be given in the Patronaat
                venue. On sunday the bands will play on The Grote Markt for everyone to see!
            </div> <br>
            <div class="partials-home-welcome-text"> Electronic dance music (EDM), also known as dance music, club
                music, or simply dance, is a broad range of percussive electronic music genres made largely for
                nightclubs, raves, and festivals. Dance is usually produced by DJ’s. The DJ’s create a mix of there
                music by segueing from one recording to another. The artists will play these tracks on Haarlem Fesitval.
            </div> <br>
            <div class="partials-home-welcome-text">
                Always been curious what Haarlem has to offer? This is what the festival is all about. On this page you
                can find the best restaurants in town and what they have to offer. Enjoy the taste of Haarlem and their
                finests chefs. The respected chefs from the restaurants affiliated to the Haarlem festival want to give
                you an expression of the culinairy activities. This will be in a form of an workshop at the restaurant,
                or can be followed at home. If you have an allergy please let us know in the reservation.
            </div> <br>

        </div>

        <div>
            Events
            @foreach($events as $event)

                {{$event->title}}

            @endforeach
            <div>

            </div>
@endsection
