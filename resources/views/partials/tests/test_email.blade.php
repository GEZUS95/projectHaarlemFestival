@extends('layout.main')
@section('content')

    <h1>Email-Test</h1>

    <form id="email_form" action="{{\Matrix\Managers\RouteManager::getUrlByRouteName("test_email_post")}}" method="post">
        <input type = "hidden">
        Email: <input type="email" name="email" id="email" required><br>
        Subject: <input type="text" name="subject" id="subject" required><br>
        Message: <input type="text" name="message" id="message" required><br>
        <input type="submit">
    </form>
    <br>
    <br>
    <h1>CSS Email-Test</h1>
    <form id="email_form" action="{{\Matrix\Managers\RouteManager::getUrlByRouteName("test_CSS_email_post")}}" method="post">
        <input type = "hidden">
        Email: <input type="email" name="email" id="email" required><br>
        Subject: <input type="text" name="subject" id="subject" required><br>
        Message: <input type="text" name="message" id="message" required><br>
        <input type="submit">
    </form>

@endsection