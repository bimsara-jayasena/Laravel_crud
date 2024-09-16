<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    @vite(['resources/css/app.css'])
</head>

<body class="h-[100vh]">

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fault();
        });
    </script>
    @endif
    <!-- Errors -->
    <section class=" -translate-y-[4rem] bg-red-500 w-full h-[4rem]  flex justify-center items-center" id='msg-er'>
        <h2 class="text-xl text-white">Invalid Credentials</h2>
    </section>

    <h1 class="text-[5rem] font-bold text-center"> Welcome to the aaa store</h1>
    <section class=" h-[100vh] flex justify-center items-center flex-col">
       
        <form method="POST" action="{{ route('login') }}" class="flex flex-col justify-center">
            @csrf
            <div>

                <input

                    type="username"
                    name="username"
                    required
                    autocomplete="username"
                    placeholder="user name"
                    class="border border-sky-500 w-[20rem] h-[2.5rem] mb-4 p-1 focus:border-sky-blue-400" />

            </div>
            <div>

                <input

                    type="password"
                    name="password"
                    required
                    autocomplete="password"
                    placeholder="password"
                    class="border border-sky-500 w-[20rem] h-[2.5rem] mb-2 p-1" />

            </div>


            <input type="submit" value="Log in" class="border rounded bg-sky-500 p-2 text-white " />

        </form>
        or
        <a href="{{ route('register') }}" class="border rounded bg-sky-500 p-2 text-white w-[20rem] text-center">Create new account</a>
    </section>
    <script>
        function fault() {
            console.log('chec');
           
            const alert = document.getElementById('msg-er');
            alert.classList.replace('-translate-y-[4rem]', 'translate-y-0');
            alert.classList.add('transition');
            alert.classList.add('ease-out');
            alert.classList.add('duration-300');
            setTimeout(hideErr, 3000);
        }

        function hideErr() {
            console.log('chec');
            const alert = document.getElementById('msg-er');
            alert.classList.replace('translate-y-0', '-translate-y-[4rem]');
           

        }
    </script>
</body>

</html>