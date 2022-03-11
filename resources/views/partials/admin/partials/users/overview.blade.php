@extends('partials.admin.layout.main')
@section('content')
    <admin-sub-navigation title="Users"></admin-sub-navigation>

    <paginator-component
            fields='name|email'
            url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_users_paginator")}}"
            search_url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_users_search")}}"
            update_event="modal-update-user"
            create_event="modal-create-user"
            title="User"
            object_name="users"
    ></paginator-component>

    <create-user-modal
            token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("users_create_form_csrf_token")}}"
            url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_users_save")}}"
            roles_url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_users_roles")}}"
    ></create-user-modal>

@endsection
