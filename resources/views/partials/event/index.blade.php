@extends('layout.main')
@section('content')

    <style>
        .partials-event-index-programs-schedule {
            font-size: 36px;
            font-weight: bold;
            color: #5A5D61;
            margin: 20px 5px 5px 20px;
        }

        .partials-event-index-programs-text {
            margin: 5px 5px 10px 20px;
        }
    </style>

    <div class="partials-event-index">
        <div class="partials-event-index-container">
            <img src="{{\Matrix\Managers\RouteManager::getUrlByRouteName("images", ["slug" => $event->images[0]->file_location])}}"
                 alt="haarlem"
                 class="partials-event-index-image"
            >

            <div class="partials-event-index-image-title">Haarlem Festival {{$event->title}}</div>
        </div>

        <div class="partials-event-index-info">
            <div class="partials-event-index-info-title">Explore {{$event->title}}</div>
            <div class="partials-event-index-info-text"> {{$event->description}}</div>
        </div>

        <div class="partials-event-index-wrapper">
            <div class="partials-event-index-programs-schedule">Schedule</div>
            <div class="partials-event-index-programs-text">
                The Haarlem Festival {{$event->title}} event is spread across {{count($event->programs)}} days and every
                day there will be performers
                for the public to see! Click on a tile below to see the schedule of the corresponding day.
            </div>
            <div class="partials-event-index-programs">
                @foreach($event->programs as $program)
                    <div style="width: {{100 / count($event->programs) . "%"}}"
                         class="partials-event-index-programs-container">

                        <img src="{{\Matrix\Managers\RouteManager::getUrlByRouteName("images", ["slug" => $program->items[array_rand($program->items->toArray())]->location->images[0]->file_location])}}"
                             alt="haarlem"
                             class="partials-event-index-programs-images"
                        >

                        <div class="partials-event-index-programs-date">
                            {{\Carbon\Carbon::parse($program->start_time)->format('D d F Y')}}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="partials-event-index-performers">

            </div>

            <div class="partials-event-index-programs-schedule">Locations</div>
            <div class="partials-event-index-programs-text">
                The Haarlem Festival dance {{$event->title}} is spread across multiple locations. Through out the event artists will
                perform at these locations on multiple days! Click on a tile below for more information.
            </div>
            <div class="partials-event-index-programs">
                @foreach($locations as $location)
                    <div style="width: {{100 / count($locations) . "%"}}"
                         class="partials-event-index-programs-container">

                        <img src="{{\Matrix\Managers\RouteManager::getUrlByRouteName("images", ["slug" => $location->images[0]->file_location])}}"
                             alt="haarlem"
                             class="partials-event-index-programs-images"
                        >

                        <div class="partials-event-index-programs-date">
                            {{$location->name}}
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </div>
@endsection
