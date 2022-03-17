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

    <update-user-modal
            token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("users_update_form_csrf_token")}}"
            url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_users_update")}}"
            query_url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_users_single")}}"
            delete_url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_users_delete")}}"
            roles_url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_users_roles")}}"
    ></update-user-modal>

@endsection
