<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
{{--    disable caching     --}}
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <link rel="stylesheet" href="{{\Matrix\Managers\RouteManager::getUrlByRouteName("css")}}">
    <title>Haarlem Festival</title>
</head>
<body>
@include("layout.nav")
<main>
    @yield("content")
</main>
@include("layout.footer")


<script type="text/javascript" src="{{\Matrix\Managers\RouteManager::getUrlByRouteName("js")}}"></script>
</body>
</html>
