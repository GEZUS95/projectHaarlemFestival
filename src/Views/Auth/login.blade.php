<h1>Login</h1>

<form action="/login" method="post">
    <input type="hidden" name="token" value="{{\Matrix\SessionManager::getSessionManager()->get("login_form_csrf_token")}}">
    Email: <input type="text" name="name"><br>
    Password: <input type="text" name="email"><br>
    <input type="submit">
</form>