@extends('layout.main')
@section('content')

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

            <div class="partials-event-program-b-tickets-body">
                @foreach($program->items as $item)
                    <div class="partials-event-program-b-tickets">
                        <div class="partials-event-program-b-tickets-time">
                            <div>{{\Carbon\Carbon::parse($item->start_time)->format('H:i')}}</div>
                            <div>- {{\Carbon\Carbon::parse($item->start_time)->format('H:i')}}</div>
                        </div>

                        <div>
                            <div class="partials-event-program-b-tickets-performer">{{$item->performer->name}}</div>
                            <div class="partials-event-program-b-tickets-location">{{$item->location->name}}</div>
                            <div class="partials-event-program-b-tickets-price">&euro;{{number_format($item->price, 2, '.', ',')}}</div>
                        </div>

                        <buy-item-ticket
                                route="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order_add")}}"
                                token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("validate_form_token")}}"
                                item_id="{{$item->id}}"
                                performer_name="{{$item->performer->name}}"
                        ></buy-item-ticket>
                    </div>
                    <hr>
                @endforeach
            </div>

            <div class="partials-event-program-b-tickets-footer">
                <buy-program-ticket
                        route="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order_add")}}"
                        token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("validate_form_token")}}"
                        program_id="{{$program->id}}"
                ></buy-program-ticket>
            </div>
        </div>

    </div>
@endsection
