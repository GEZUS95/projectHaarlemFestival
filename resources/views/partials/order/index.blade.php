@extends('layout.main')
@section('content')

    <style>

    </style>

    <div class="partials-order-index">

        <img src="{{\Matrix\Managers\RouteManager::getUrlByRouteName("images", ["slug" => $image_link])}}"
             alt="haarlem"
             class="partials-order-index-image-background"
        >

        <div class="partials-order-index-container">
            <div class="partials-order-index-container-bread">
                <div class="partials-order-index-container-bread-text"><a href="{{Matrix\Managers\RouteManager::getUrlByRouteName('home')}}">Home</a> > Shopping Cart</div>
                <div class="partials-order-index-container-bread-line"></div>
            </div>
            <div class="partials-order-index-container-inner">
                <div class="partials-order-index-cart">
                    <h1>Shopping Cart</h1>
                    <div class="partials-order-index-cart-inner">
                        @foreach($order["events"] as $event)
                            <hr>
                            <div class="partials-order-index-cart-inner-con">
                                <div class="partials-event-program-b-tickets-time">
                                    <div>{{\Carbon\Carbon::parse($event->start_time)->format('d m H:i')}}</div>
                                    <div>&nbsp- {{\Carbon\Carbon::parse($event->end_time)->format('d m H:i')}}</div>
                                </div>

                                <div class="partials-event-program-con">
                                    <div class="partials-event-program-b-tickets-performer">Week Pass</div>
                                </div>

                                <cart-change-ticket
                                        route="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order_add")}}"
                                        token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("validate_form_token")}}"
                                        id="{{$event->id}}"
                                        type="Event"
                                        amount="{{$event->count}}"
                                ></cart-change-ticket>
                            </div>
                            <hr>
                        @endforeach

                        @foreach($order["programs"] as $program)
                            <hr>
                            <div class="partials-order-index-cart-inner-con">
                                <div class="partials-event-program-b-tickets-time">
                                    <div>{{\Carbon\Carbon::parse($program->start_time)->format('d m H:i')}}</div>
                                    <div>&nbsp - {{\Carbon\Carbon::parse($program->end_time)->format('d m H:i')}}</div>
                                </div>

                                <div class="partials-event-program-con">
                                    <div class="partials-event-program-b-tickets-performer">Day Pass</div>
                                </div>

                                <cart-change-ticket
                                        route="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order_add")}}"
                                        token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("validate_form_token")}}"
                                        id="{{$program->id}}"
                                        type="Program"
                                        amount="{{$program->count}}"
                                ></cart-change-ticket>
                            </div>

                            <hr>
                        @endforeach

                        @foreach($order["items"] as $item)
                            <hr>
                            <div class="partials-order-index-cart-inner-con">
                                <div class="partials-event-program-b-tickets-time">
                                    <div>{{\Carbon\Carbon::parse($item->start_time)->format('H:i')}}</div>
                                    <div>&nbsp- {{\Carbon\Carbon::parse($item->end_time)->format('H:i')}}</div>
                                </div>

                                <div class="partials-event-program-con">
                                    <div class="partials-event-program-b-tickets-performer">{{$item->performer->name}}</div>
                                    <div class="partials-event-program-b-tickets-location">{{$item->location->name}}</div>
                                </div>

                                <cart-change-ticket
                                        route="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order_add")}}"
                                        token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("validate_form_token")}}"
                                        id="{{$item->id}}"
                                        type="Item"
                                        amount="{{$item->count}}"
                                ></cart-change-ticket>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <div class="partials-order-index-cart-inner-footer">
                        <p>&euro;{{number_format($total_price, 2, '.', ',')}}</p>
                        <a class="partials-event-program-pay-btn" href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order_pay")}}">Pay</a>
                    </div>
                </div>

                <div class="partials-order-index-extra-sales">
                    <div class="partials-order-index-extra-sales-line"></div>
                    <div class="partials-order-index-extra-sales-items">
                        Extra Items
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
