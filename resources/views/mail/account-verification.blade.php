HTML
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Email Verification</title>
</head>

<body>

    <h1>Verify Your Email Address</h1>

    <p>A verification link has been sent to your email address. Please click the link below to verify your account.</p>

    <form method="GET" action="{{ $verificationUrl }}">
        @csrf
        <button type="submit">Verify Email Address</button>
    </form>

</body>