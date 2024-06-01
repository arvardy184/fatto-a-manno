<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Forgot Password</title>

</head>

<body style=" min-height: 100vh; display: flex; align-items: center; justify-content: center;">

    <div style="padding: 2rem; border-radius: 0.5rem; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); max-width: 20rem;">
        <h1 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1rem;">Forgot Password</h1>

        <p style="margin-bottom: 1rem;">A new password has been issued.</p>
        <p style="margin-bottom: 1rem;">Password: {{ $newPassword }}</p>

        <form method="GET" action="{{ $url }}">
            @csrf
            <button type="submit"
                style="background-color: #3490dc; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; cursor: pointer; transition: background-color 0.3s ease;">Login
                Here</button>
        </form>
    </div>

</body>

</html>
