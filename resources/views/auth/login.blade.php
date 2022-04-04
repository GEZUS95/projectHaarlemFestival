@extends('layout.main')
@section('content')

    <div class="auth-layout">
        <form class="auth-layout-form" action="{{\Matrix\Managers\RouteManager::getUrlByRouteName("login")}}" method="post">
            <h1>Login</h1>
            <input type="hidden" name="token" value="{{\Matrix\Managers\SessionManager::getSessionManager()->get("login_form_csrf_token")}}">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email"><br>
            <label for="password">Password:</label>
            <input type="text" name="password" id="password"><br>
            <div class="auth-layout-btn">
                <input class="btn" type="submit">
            </div>
        </form>

    </div>

@endsection
