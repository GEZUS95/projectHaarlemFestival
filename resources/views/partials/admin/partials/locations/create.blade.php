@extends('partials.admin.layout.main')
@section('content')
    <admin-sub-navigation title="Locations"></admin-sub-navigation>

    <create-location-form
        token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("login_form_csrf_token")}}"
        url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_locations_save")}}"
    ></create-location-form>
@endsection
