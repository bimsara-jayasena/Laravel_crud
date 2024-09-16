<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>
<body>
    @if(session('error'))
    <div>{{session('error')}}</div>
    @endif
    <h1>Test Page</h1>
</body>
</html>