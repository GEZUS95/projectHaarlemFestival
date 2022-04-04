@extends('layout.main')
@section('content')
    <div class="auth-layout">


<form class="auth-layout-form" action="{{\Matrix\Managers\RouteManager::getUrlByRouteName("register_post")}}" id="register" method="post">
    <h1>Register</h1>
    <input type="hidden" name="token" value="{{\Matrix\Managers\SessionManager::getSessionManager()->get("register_form_csrf_token")}}">
    <label for="name">Name: </label>
    <input id="name" name="name" required><br>
    <label for="email">Email: </label>
    <input id="email" type="email" name="email" required><br>
    <label for="email-confirm">Email Confirm: </label>
    <input id="email-confirm" type="text" name="email_confirmation" required><br>
    <label for="password">Password: </label>
    <input id="password" type="password" name="password" required><br>
    <label for="password-confirm">Password Confirm:</label>
    <input id="password-confirm" type="password" name="password_confirmation" required><br>
    <div class="auth-layout-btn">
        <input class="btn" type="submit">
    </div>
</form>
    </div>
@endsection
