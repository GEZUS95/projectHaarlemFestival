@extends('partials.admin.layout.main')
@section('content')


    <event-sub-navigation title="{{$event_title}}"></event-sub-navigation>
    <style>
        event-overview-page {
            scrollbar-width: none; /* For Firefox */
            -ms-overflow-style: none; /* For Internet Explorer and Edge */
        }

        event-overview-page::-webkit-scrollbar {
            width: 0; /* For Chrome, Safari, and Opera */
        }
    </style>
    <event-overview-page link="{{\Matrix\Managers\RouteManager::getUrlByRouteName("admin_event_json", ["title" => $event_title])}}" style="overflow-y: scroll"></event-overview-page>

    <create-program-modal></create-program-modal>
@endsection