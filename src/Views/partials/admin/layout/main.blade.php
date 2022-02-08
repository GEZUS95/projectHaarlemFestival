<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="http://127.0.0.1:4321/main.css">
    <title>Document</title>
</head>
<body>
@include("partials.admin.layout.nav")
<main>
    @yield("content")
</main>
@include("partials.admin.layout.footer")

<script type="text/javascript" src="http://127.0.0.1:4321/main.js"></script>
</body>
</html>