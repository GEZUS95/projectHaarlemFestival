@extends('layout.main')
@section('content')

    <h1>Email-Test</h1>

    <form id="email_form" action="{{\Matrix\Managers\RouteManager::getUrlByRouteName("test_email_post")}}" method="post">
        <input type="hidden" name="token" value="{{\Matrix\Managers\SessionManager::getSessionManager()->get("email_test_form_csrf_token")}}">
        Email: <input type="email" name="email" id="email" required><br>
        Subject: <input type="text" name="subject" id="subject" required><br>
        Message: <input type="text" name="message" id="message" required><br>
        <input type="submit">
    </form>
    <br>
@endsection