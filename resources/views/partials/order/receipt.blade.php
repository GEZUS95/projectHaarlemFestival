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

        .partials-order-index-cart-inner {
            min-width: 600px;
        }

        .partials-order-index-cart-inner-con {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding-right: 30px;
        }

    </style>

    <div class="partials-order-index">

        <img src="{{\Matrix\Managers\RouteManager::getUrlByRouteName("assets", ["slug" => "banner.jpg"])}}"
             alt="haarlem"
             class="partials-order-index-image-background"
        >

        <div class="partials-order-index-container">
            <div class="partials-order-index-container-bread">
                <div class="partials-order-index-container-bread-text"><a href="{{Matrix\Managers\RouteManager::getUrlByRouteName('home')}}">Home</a> > Receipt</div>
                <div class="partials-order-index-container-bread-line"></div>
            </div>
            <div class="partials-order-index-container-inner">
                <div class="partials-order-index-cart">
                    <h1>Receipt</h1>
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

                                <div>
                                    Amount: {{$event->count}}
                                </div>
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

                                <div>
                                    Amount: {{$program->count}}
                                </div>
                            </div>

                            <hr>
                        @endforeach

                        @foreach($order["items"] as $item)

                            <hr>
                            <div class="partials-order-index-cart-inner-con">
                                <div class="partials-event-program-b-tickets-time">
                                    <div>{{\Carbon\Carbon::parse($item->start_time)->format('d m H:i')}}</div>
                                    <div>&nbsp;- {{\Carbon\Carbon::parse($item->end_time)->format('d m H:i')}}</div>
                                </div>

                                <div>
                                    <div class="partials-event-program-b-tickets-performer">{{$item->performer->name}}</div>
                                    <div class="partials-event-program-b-tickets-location">{{$item->location->name}}</div>
                                </div>

                                <div>
                                    Amount: {{$item->count}}
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
