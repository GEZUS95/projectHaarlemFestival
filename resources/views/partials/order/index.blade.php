@extends('layout.main')
@section('content')

    <style>
        .partials-order-index {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .partials-order-index-image-background {
            height: 1000px;
            width: 100%;
            object-fit: fill;
        }

        .partials-order-index-container {
            box-sizing: border-box;
            background: white;
            max-width: 1100px;
            padding: 10px 40px 0 40px;
            height: calc(100% - 30px);
            position: absolute;
            margin-top: 20px;
            margin-bottom: 10px;
            box-shadow: 1px 1px 10px -6px #000000;
            overflow: hidden;
        }

        .partials-order-index-cart {
            min-width: 600px;
            align-items: center;
            display: flex;
            flex-direction: column;
        }

        .partials-order-index-extra-sales {
            height: 100%;
            min-width: 250px;
            display: flex;
            flex-direction: row;
        }

        .partials-order-index-container-inner {
            height: 100%;
            display: flex;
            flex-direction: row;
        }

        .partials-order-index-container-bread {
            display: flex;
            flex-direction: column;
        }

        .partials-order-index-container-bread-line {
            width: 100%;
            height: 2px;
            background: #000000;
        }

        .partials-order-index-container-bread-text {
            color: #000000;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .partials-order-index-extra-sales-line {
            height: 100%;
            width: 2px;
            background: #000000;
        }

        .partials-order-index-cart-inner {
            min-width: 600px;
        }

        .partials-order-index-cart-inner-con {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding-right: 30px;
        }

        .partials-order-index-cart-inner-footer {
            margin-top: auto;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 20px;
            height: 100px;
        }
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
                                    <div>- {{\Carbon\Carbon::parse($event->end_time)->format('d m H:i')}}</div>
                                </div>

                                <div>
                                    <div class="partials-event-program-b-tickets-performer">Week Pass</div>
                                </div>

                                <cart-change-ticket
                                        route="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order_add")}}"
                                        token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("validate_form_token")}}"
                                        id="{{$event->id}}"
                                        type="App\Model\Event"
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
                                    <div>- {{\Carbon\Carbon::parse($program->end_time)->format('d m H:i')}}</div>
                                </div>

                                <div>
                                    <div class="partials-event-program-b-tickets-performer">Day Pass</div>
                                </div>

                                <cart-change-ticket
                                        route="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order_add")}}"
                                        token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("validate_form_token")}}"
                                        id="{{$program->id}}"
                                        type="App\Model\Program"
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
                                    <div>- {{\Carbon\Carbon::parse($item->end_time)->format('H:i')}}</div>
                                </div>

                                <div>
                                    <div class="partials-event-program-b-tickets-performer">{{$item->performer->name}}</div>
                                    <div class="partials-event-program-b-tickets-location">{{$item->location->name}}</div>
                                </div>

                                <cart-change-ticket
                                        route="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order_add")}}"
                                        token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("validate_form_token")}}"
                                        id="{{$item->id}}"
                                        type="App\Model\Item"
                                        amount="{{$item->count}}"
                                ></cart-change-ticket>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <div class="partials-order-index-cart-inner-footer">
                        <a style="font-size: 30px; font-weight: bold" href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order_pay")}}">Pay</a>
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
