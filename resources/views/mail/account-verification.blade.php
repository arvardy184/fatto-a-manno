<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Email Verification</title>
    <style>
        button {
            background-color: #3490dc;
            color: #ffffff;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2779bd;
        }
    </style>
</head>

<body>

    <h1 style="margin-bottom: 1rem;">Verify Your Email Address</h1>
    <p style="margin-bottom: 1rem;">A verification link has been sent to your email address. Please click the link below
        to verify your account.</p>

    <form method="GET" action="{{ $verificationUrl }}">
        @csrf
        <button type="submit">Verify Email Address</button>
    </form>

</body>
