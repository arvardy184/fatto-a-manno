<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    @auth
    <h1>User JSON Data</h1>
    <pre>{{ json_encode(auth()->user(), JSON_PRETTY_PRINT) }}</pre>

    @else
    <h1>Login</h1>
    <form method="POST" action="/login">
        @csrf
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
    @endauth
</body>

</html>