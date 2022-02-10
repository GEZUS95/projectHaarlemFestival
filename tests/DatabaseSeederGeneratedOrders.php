<?php

require_once dirname(__DIR__, 1)."/Boot.php";

use App\Model\Event;
use App\Model\Item;
use App\Model\Program;
use App\Model\User;

$event = Event::find(1);

foreach ($event->orders as $order) {
    var_dump("Event order");
    var_dump($order->user->email);
}

$program = Program::find(1);
foreach ($program->orders as $order) {
    var_dump("Program orders");
    var_dump($order->user->email);
}

$item = Item::find(1);
foreach ($item->orders as $order) {
    var_dump("item orders");
    var_dump($order->user->email);
}

$user = User::find(1);
foreach ($user->orders as $order) {
    var_dump("event price");
    var_dump($order->events[0]->total_price_event);

    var_dump("program price");
    var_dump($order->programs[0]->total_price_program);

    var_dump("items price");
    var_dump($order->items[0]->price);
}
