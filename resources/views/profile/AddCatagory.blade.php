<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @if(session('success'))
    <h3>{{session('success')}}</h3>
    @endif
    <h2>Add Catagory</h2>

    <form action="{{route('category.store')}}" method="POST">
        @csrf
        <input type="text" name="catagory" id="name"><br>
        <input type="submit" value="Save">
    </form>
    <a href="{{route('dashboard')}}">back to the dashboard</a>
</body>

</html>