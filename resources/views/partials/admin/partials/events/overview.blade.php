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
    <event-overview-page style="overflow-y: scroll"></event-overview-page>
@endsection