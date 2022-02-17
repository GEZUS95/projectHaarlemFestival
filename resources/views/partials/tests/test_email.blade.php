@extends('layout.main')
@section('content')
    <h1>Email-Test</h1>

    <form action="" method="post">
        <input type = "hidden">
        Email: <input type="email" name="Email address of the recipient:" required><br>
        Message: <input type="text" name="Message:" required><br>
        <input type="submit">
    </form>
@endsection