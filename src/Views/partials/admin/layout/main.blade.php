<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
    }

    footer {
        margin-top: auto;
    }

    body {
        display: flex;
        flex-direction: column;
    }
</style>
<body>
@include("partials.admin.layout.nav")
<main>
    @yield("content")
</main>
@include("partials.admin.layout.footer")
</body>
</html>