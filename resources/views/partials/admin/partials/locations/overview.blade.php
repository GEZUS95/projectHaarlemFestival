@extends('partials.admin.layout.main')
@section('content')
    <admin-sub-navigation title="Locations"></admin-sub-navigation>
    <paginator-component
            fields='city|address|name|seats'
            url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_locations_paginator")}}"
            update_event="modal-update-location"
            create_event="modal-create-location"
            title="Location"
            object_name="location"
    ></paginator-component>

    <create-location-modal
            token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("locations_create_form_csrf_token")}}"
            url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_locations_save")}}"
    ></create-location-modal>

    <update-location-modal
        token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("locations_update_form_csrf_token")}}"
        url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_locations_update")}}"
        query_url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_locations_single")}}"
        delete_url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_locations_delete")}}"
    ></update-location-modal>
@endsection
