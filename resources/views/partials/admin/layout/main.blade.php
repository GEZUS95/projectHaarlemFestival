<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Document</title>

    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-store" />
    <meta http-equiv="expires" content="-1" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
</head>
<body>
@include("partials.admin.layout.nav")
<main class="partials-admin-layout-main">
    @include("partials.admin.layout.sidenav")
    <div class="partials-admin-layout-main-content">
        @yield("content")
    </div>
</main>

<create-event-modal
        token="{{\Matrix\Managers\SessionManager::getSessionManager()->get("event_create_form_csrf_token")}}"
        url="{{\Matrix\Managers\RouteManager::getUrlWithOutFilledParameters("admin_locations_save")}}"
></create-event-modal>

<script type="text/javascript" src="{{\Matrix\Managers\RouteManager::getUrlByRouteName("js")}}"></script>
</body>
</html>