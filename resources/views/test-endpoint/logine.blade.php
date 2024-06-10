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
    <button id="testButton">Run Test</button>
    <button id="logout">Log out</button>
    @else
    <h1>Login</h1>
    <form method="POST" action="/signin">
        @csrf
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
    @endauth

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            document.getElementById("testButton").addEventListener("click", function() {
                fetch("/test")
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        // If you want to do something with the response, you can do it here
                        return response.json();
                    })
                    .then(data => {
                        console.log(data);
                    })
                    .catch(error => {
                        console.error("There was a problem with the fetch operation:", error);
                    });
            });
            document.getElementById("logout").addEventListener("click", function() {
                fetch("/logout")
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        window.location.reload();
                    })
            });
        });
    </script>
</body>

</html>