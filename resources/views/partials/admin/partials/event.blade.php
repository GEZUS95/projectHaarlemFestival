@extends('partials.admin.layout.main')
@section('content')
    <event-sub-navigation title="{{$event_title}}"></event-sub-navigation>

    <event-overview-page link="{{\Matrix\Managers\RouteManager::getUrlByRouteName("admin_event_overview", ["title" => $event_title])}}" style="overflow-y: scroll"></event-overview-page>

    <create-program-modal
            url="{{\Matrix\Managers\RouteManager::getUrlByRouteName("admin_program_create")}}"
    ></create-program-modal>

    <create-event-modal
            token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("event_create_form_csrf_token")}}"
            url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_event_save")}}"
    ></create-event-modal>
@endsection