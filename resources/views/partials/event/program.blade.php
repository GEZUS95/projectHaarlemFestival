@extends('layout.main')
@section('content')

    <style>
        .partials-event-program {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .partials-event-program-container {
            background: white;
            width: 1100px;
            height: calc(100% - 30px);
            position: absolute;
            margin-top: 20px;
            margin-bottom: 10px;
            box-shadow: 1px 1px 10px -6px #000000;
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .partials-event-program-image-background {
            height: 1000px;
            width: 100%;
            object-fit: fill;
        }

        .partials-event-program-tickets-container-date-con {
            display: flex;
            align-items: center;
            flex-direction: row;
        }

        .partials-event-program-tickets-container {
            width: 850px;
        }

        .partials-event-program-tickets-container-date {
            font-size: 24px;
            font-weight: bold;
            width: 200px;
        }

        .partials-event-program-tickets-container-date-line {
            width: 100%;
            height: 2px;
            background: #000000;
            padding-left: 20px;
        }

        .partials-event-program-b-tickets {
            display: flex;
            width: 850px;
            justify-content: space-between;
        }

        .partials-event-program-b-tickets-performer {
            font-size: 18px;
            font-weight: bold;

        }

        .partials-event-program-b-tickets-location {
            font-size: 16px;
            font-weight: lighter;
        }

        .partials-event-program-b-tickets-time {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            padding-left: 30px;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
    <div class="partials-event-program">

        <img src="{{\Matrix\Managers\RouteManager::getUrlByRouteName("images", ["slug" => $program->event->images[0]->file_location])}}"
             alt="haarlem"
             class="partials-event-program-image-background"
        >

        <div class="partials-event-program-container">
            <h1>{{$program->event->title}} Schedule</h1>

            <div class="partials-event-program-tickets-container">
                <div class="partials-event-program-tickets-container-date-con">
                    <div class="partials-event-program-tickets-container-date">{{\Carbon\Carbon::parse($program->start_time)->format('D d F')}}</div>
                    <div class="partials-event-program-tickets-container-date-line"></div>
                </div>
            </div>

            <div>
                @foreach($program->items as $item)
                    <div class="partials-event-program-b-tickets">
                        <div class="partials-event-program-b-tickets-time">
                            <div>{{\Carbon\Carbon::parse($item->start_time)->format('H:i')}}</div>
                            <div>- {{\Carbon\Carbon::parse($item->start_time)->format('H:i')}}</div>
                        </div>

                        <div>
                            <div class="partials-event-program-b-tickets-performer">{{$item->performer->name}}</div>
                            <div class="partials-event-program-b-tickets-location">{{$item->location->name}}</div>
                        </div>

                        <form method="POST" action="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order_add")}}">
                            <input type="hidden" value="{{\Matrix\Managers\SessionManager::getSessionManager()->get("validate_form_token")}}" name="token">
                            <input type="number" value="0" name="amount">
                            <input type="hidden" value="{{$item->id}}" name="id">
                            <input type="hidden" value="item" name="type">
                            <input type="submit" value="Add to Cart">
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
