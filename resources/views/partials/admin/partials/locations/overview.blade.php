@extends('partials.admin.layout.main')
@section('content')
    <admin-sub-navigation title="Locations"></admin-sub-navigation>
    <paginator-component
            fields='city|address|name|seats'
            url="{{\Matrix\Managers\RouteManager::getUrlByRouteName("admin_locations_paginator", array("page" => 0, "amount" => 10))}}"
    ></paginator-component>
@endsection
