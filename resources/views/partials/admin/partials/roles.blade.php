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

    <create-role-modal
            token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("roles_create_form_csrf_token")}}"
            perms="{{json_encode(\App\Model\Permissions::getAllPermissions())}}"
            url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_roles_save")}}"
    ></create-role-modal>

    <update-role-modal
            token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("roles_update_form_csrf_token")}}"
            perms="{{json_encode(\App\Model\Permissions::getAllPermissions())}}"
            url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_roles_update")}}"
            query_url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_roles_single")}}"
            delete_url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_roles_delete")}}"
    ></update-role-modal>
@endsection
