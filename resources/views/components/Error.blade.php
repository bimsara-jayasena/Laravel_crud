<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="v-[100vh] flex justify-center items-center flex-col">
   
    <img src="{{asset('error_401.jpg')}}" alt="">
   <a href="{{route('Home')}}"> <button class="bg-sky-500 p-2 rounded w-[10rem] text-white font-bold">take me back</button></a>
</body>
</html>