@extends('partials.admin.layout.main')
@section('content')
    <admin-sub-navigation title="Performer"></admin-sub-navigation>
    <paginator-component
            fields='name|type'
            url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_performers_paginator")}}"
            search_url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_performers_search")}}"
            update_event="modal-update-performer"
            create_event="modal-create-performer"
            title="Performer"
            object_name="performer"
    ></paginator-component>

    <create-performer-modal
            token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("performer_create_form_csrf_token")}}"
            url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_performers_save")}}"
    ></create-performer-modal>
@endsection