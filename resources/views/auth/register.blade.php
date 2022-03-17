@extends('layout.main')
@section('content')
<h1>Register</h1>

<form action="{{\Matrix\Managers\RouteManager::getUrlByRouteName("register_post")}}" method="post">
    <input type="hidden" name="token" value="{{\Matrix\Managers\SessionManager::getSessionManager()->get("register_form_csrf_token")}}">
    Name: <input name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Email Confirm: <input type="text" name="email_confirmation" required><br>
    Password: <input type="password" name="password" required><br>
    Password Confirm: <input type="password" name="password_confirmation" required><br>
    <input type="submit">
</form>
@endsection
