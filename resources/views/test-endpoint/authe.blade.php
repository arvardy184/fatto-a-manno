<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
</head>

<body>
    @if(auth()->check())
    <h1>User JSON Data</h1>
    <pre>{{ json_encode(auth()->user(), JSON_PRETTY_PRINT) }}</pre>
    <button id="testButton">Run Test</button>
    @else
    <h1>User Registration</h1>
    <form method="POST" action="/register">
        @csrf
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address"><br>
        <label for="number">Number:</label><br>
        <input type="text" id="number" name="number"><br><br>
        <input type="submit" value="Register">
    </form>
    @endif

    <script>
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
    </script>
</body>

</html>