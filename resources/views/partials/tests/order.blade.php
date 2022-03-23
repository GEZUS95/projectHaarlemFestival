
{{$order->uuid}}

{{$order->items[0]->performer->name}}


<h1> add </h1>
<form id="order_add_form" action="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order_add")}}" method="post">
    Id: <input type="text" name="id" id="id" required><br>
    Type: <input type="text" name="type" id="type" required><br>
    <input type="submit">
</form>

<h1> remove</h1>

<form id="order_remove_form" action="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order_remove")}}" method="post">
    Id: <input type="text" name="id" id="id" required><br>
    Type: <input type="text" name="type" id="type" required><br>
    <input type="submit">
</form>

<h1> delete</h1>

<form id="order_delete_form" action="{{\Matrix\Managers\RouteManager::getUrlByRouteName("order_delete")}}" method="post">
    <input type="submit">
</form>