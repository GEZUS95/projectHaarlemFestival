@extends('layout.main')
@section('content')

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
                                    <div>{{\Carbon\Carbon::parse($event->start_time)->format('Y M D H:i')}}</div>
                                    <div>&nbsp- {{\Carbon\Carbon::parse($event->end_time)->format('H:i')}}</div>
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
                                    <div>{{\Carbon\Carbon::parse($program->start_time)->format('Y M D H:i')}}</div>
                                    <div>&nbsp - {{\Carbon\Carbon::parse($program->end_time)->format('H:i')}}</div>
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
                                    <div>{{\Carbon\Carbon::parse($item->start_time)->format('Y M D H:i')}}</div>
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
                        <p><span style="font-weight: bold">Subtotal:</span>&nbsp &euro;{{number_format($total_price, 2, '.', ',')}}</p>
                        <a class="partials-event-program-pay-btn" href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order_pay")}}">Pay</a>
                    </div>
                </div>

                <div class="partials-order-index-extra-sales">
                    <div class="partials-order-index-extra-sales-line"></div>
                    <div class="partials-order-index-extra-sales-items">

                        <style>
                            .partials-order-index-extra-sales-items-card {
                                position: relative;
                                display: -webkit-box;
                                display: -ms-flexbox;
                                display: flex;
                                -webkit-box-orient: vertical;
                                -webkit-box-direction: normal;
                                -ms-flex-direction: column;
                                flex-direction: column;
                                min-width: 0;
                                word-wrap: break-word;
                                background-color: #fff;
                                background-clip: border-box;
                                border: 1px solid rgba(0,0,0,.125);
                                border-radius: 0.25rem;
                                padding: 10px;
                                box-sizing: border-box;
                                margin: 40px 10px;
                            }

                            .partials-order-index-extra-sales-items {
                                width: 100%;
                                display: flex;
                                flex-direction: column;
                                justify-content: center;
                                height: 70%;
                            }

                            .partials-order-index-extra-sales-items-card-header {
                                font-weight: bold;
                                font-size: 30px;
                                margin-bottom: 10px;
                            }

                            .partials-order-index-extra-sales-items-card-time {
                                display: flex;
                            }

                            .partials-order-index-extra-sales-items-card-price {
                                margin-bottom: 10px;
                                margin-top: 10px;
                                font-size: 14px;
                                font-weight: lighter;
                            }

                            .partials-order-index-extra-sales-items-card-btn {
                                margin-left: auto;
                                margin-right: auto;
                                background-color: #6C757D;
                                color: #ffffff;
                                padding: 5px 20px;
                            }

                        </style>
                        @foreach($sales_items as $sale)
                            <div class="partials-order-index-extra-sales-items-card">
                                <div class="partials-order-index-extra-sales-items-card-header">
                                    <div>{{$sale->performer->name}}</div>
                                    <div>{{$sale->specialGuest != null ? " - " . $sale->specialGuest->name : ""}}</div>
                                </div>
                                <div class="partials-order-index-extra-sales-items-card-time">
                                    <div>{{\Carbon\Carbon::parse($sale->start_time)->format('Y M D H:i')}}</div>
                                    <div>&nbsp-&nbsp{{\Carbon\Carbon::parse($sale->end_time)->format('H:i')}}</div>
                                </div>
                                <div>{{$sale->location->name}} {{$sale->location->stage != null ? " - " . $sale->location->stage : ""}}</div>
                                <div class="partials-order-index-extra-sales-items-card-price">price:  &euro;{{$sale->price}}</div>

                                <form style="display: flex;align-items: center;" method="post" action="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order_add")}}">
                                    <input type="hidden" value="{{\Matrix\Managers\SessionManager::getSessionManager()->get("validate_form_token")}}" name="token">
                                    <input type="hidden" value="{{$sale->id}}" name="id">
                                    <input type="hidden" value="1" name="amount">
                                    <input type="hidden" value="item" name="type">
                                    <input class="partials-order-index-extra-sales-items-card-btn" value="Add Ticket" type="submit">
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
