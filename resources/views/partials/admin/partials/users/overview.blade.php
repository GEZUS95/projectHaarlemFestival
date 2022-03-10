@extends('partials.admin.layout.main')
@section('content')
    <admin-sub-navigation title="Users"></admin-sub-navigation>

    <paginator-component
            fields='name|email'
            url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_performers_paginator")}}"
            search_url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_performers_search")}}"
            update_event="modal-update-user"
            create_event="modal-create-user"
            title="User"
            object_name="users"
    ></paginator-component>

@endsection
