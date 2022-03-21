@extends('layout.main')
@section('content')

    <h1>QR-Test</h1>

    <form id="qr-test-form" action="{{\Matrix\Managers\RouteManager::getUrlByRouteName("test_qr_post")}}" method="post">
        <input type="hidden" name="token" value="{{\Matrix\Managers\SessionManager::getSessionManager()->get("qr_test_form_csrf_token")}}">
        Make a qr code using the following data: <input type="text" name="qrData" id="qrData" required><br>
        <input type="submit">
    </form>
    <br>
@endsection