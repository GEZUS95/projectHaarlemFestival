<h1>Login</h1>

<form action="{{\Matrix\Managers\RouteManager::getUrlByRouteName("login")}}" method="post">
    <input type="hidden" name="token" value="{{\Matrix\Managers\SessionManager::getSessionManager()->get("login_form_csrf_token")}}">
    Email: <input type="text" name="email"><br>
    Password: <input type="text" name="password"><br>
    <input type="submit">
</form>