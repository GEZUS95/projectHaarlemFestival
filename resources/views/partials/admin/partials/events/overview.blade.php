@extends('partials.admin.layout.main')
@section('content')


    <event-sub-navigation title="{{$event_title}}"></event-sub-navigation>
    <event-overview-page></event-overview-page>
@endsection