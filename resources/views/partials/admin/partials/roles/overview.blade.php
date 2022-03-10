@extends('partials.admin.layout.main')
@section('content')
    <admin-sub-navigation title="Roles"></admin-sub-navigation>
    <paginator-component
            fields='name'
            url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_roles_paginator")}}"
            search_url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_roles_search")}}"
            update_event="modal-update-roles"
            create_event="modal-create-roles"
            title="Roles"
            object_name="roles"
    ></paginator-component>
@endsection
