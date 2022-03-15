@extends('partials.admin.layout.main')
@section('content')
    <event-sub-navigation title="{{$event->title}}"></event-sub-navigation>

    {{$event->id}}

    <event-overview-page
            url="{{\Matrix\Managers\RouteManager::getUrlByRouteName("admin_event_overview", ["id" => $event->id])}}"
            event_id="{{$event->id}}"
            style="overflow-y: scroll"></event-overview-page>

{{--    @todo add token to create program form--}}
    <create-program-modal
            url="{{\Matrix\Managers\RouteManager::getUrlByRouteName("admin_program_create")}}"
    ></create-program-modal>

    <create-event-modal
            token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("event_create_form_csrf_token")}}"
            url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_event_save")}}"
    ></create-event-modal>

    <update-event-modal
        token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("event_update_form_csrf_token")}}"
        url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_event_update")}}"
        query_url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_event_single")}}"
        delete_url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_event_delete")}}"
    ></update-event-modal>
@endsection