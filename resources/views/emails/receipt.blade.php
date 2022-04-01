<html>
<body>

<h1 class="title">Haarlem Festival</h1>
<h1 class="subtitle">Hi {{$args["user"]->name}}!</h1>

<p>Thanks for your order!<br>This is your confirmation email and a quick summary of the tickets you ordered!<br>
    Your tickets will be below in the form of a QR-code!</p>
<p>
<div class="partials-order-index-cart-inner">
    @foreach($args["order"]["events"] as $event)
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

    @foreach($args["order"]["programs"] as $program)
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
                Amount:{{$program->count}}
            </div>

        </div>

        <hr>
    @endforeach

    @foreach($args["order"]["items"] as $item)
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

            <div>
                Amount: {{$item->count}}
            </div>

        </div>
        <hr>
    @endforeach
</div>
</p>
<p>Below you will find unique QR-code, you
    will be able to use this code at the entrance of any event.<br>Put the generated qr-cde here and we gucci</p>

<footer>This email was sent to you to inform
    that an order has been placed using your account.<br>The email-address that this email has been sent from cannot
    receive replies.<br>Don't want automated emails? Click <a href="www.haarlemfestival.com/opt_out">here</a> to opt out<br>For
    help, visit: www.haarlemfestival.com/contact
</footer>
</body>
</html>

<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto');

    body {
        font-family: Roboto, serif;
        margin: 0;
        padding: 0;
    }

    p {
        background-color: white;
        color: #222222;
        text-align: center;
    }

    footer {
        font-size: x-small;
        background-color: #ECEFF1;
        text-align: center;
        padding: 2%
    }

    .title {
        font-size: xx-large;
        color: white;
        background-color: #1A222A;
        text-align: center;
        padding: 1%;
    }

    .subtitle {
        background-color: white;
        color: black;
        text-align: center;
        padding: 20px;
    }
</style>