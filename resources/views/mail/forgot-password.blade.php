<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Forgot Password</title>
</head>

<body>

    <h1>Forgot Password</h1>

    <p>A new password has been issued.</p>
    <p>Password: {{ $newPassword }}</p>

    <form method="GET" action="{{ $url }}">
        @csrf
        <button type="submit">Login Here</button>
    </form>

</body>
