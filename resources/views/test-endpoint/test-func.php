<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JSON Viewer</title>
    <style>
        /* Add your CSS styles for displaying JSON here */
    </style>
</head>

<body>
    <h1>JSON Response Viewer</h1>
    <pre>
        <code>
            {{ json_encode($res, JSON_PRETTY_PRINT) }}
        </code>
    </pre>
</body>

</html>