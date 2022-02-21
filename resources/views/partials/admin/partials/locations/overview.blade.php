@extends('partials.admin.layout.main')
@section('content')
    <admin-sub-navigation title="Locations"></admin-sub-navigation>
    <paginator-component
            fields='city|address|name|seats'
            url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_locations_paginator")}}"
    ></paginator-component>
@endsection
