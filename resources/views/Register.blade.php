<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite(['resources/css/app.css'])
</head>

<body class="h-[100vh] bg-sky-500">
    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fault("{{session('error')}}");
        });
    </script>
    @endif

    <!-- Errors -->
    <section class="-translate-y-[4rem]  bg-red-500 w-full h-[4rem]  flex justify-center items-center" id='msg-er'>
        <h2 class="text-xl text-white" id="text">error message</h2>
    </section>

    <h1 class="text-[5rem] font-bold text-center text-white">create new account</h1>



    <section class="flex flex-col justify-center items-center">

        <form method="post" action="{{ route('register.create') }}" class="flex flex-col gap-2 justify-center items-center mt-[10rem]">
            @csrf


            <div>
                <label for="firstname" :value="__('Name')" />
                <input class="w-[20rem]" id="firstname" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" placeholder="firstname" />
                <error :messages="$errors->get('firstname')" class="mt-2" />
            </div>
            <div>
                <label for="lastname" :value="__('Name')" />
                <input class="w-[20rem]" id="lastname" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" placeholder="lastname" />
                <error :messages="$errors->get('lastname')" class="mt-2" />
            </div>
            <div>
                <label for="email" :value="__('Name')" />
                <input class="w-[20rem]" id="email" type="text" name="email" :value="old('email')" required autofocus autocomplete="email" placeholder="email" />
                <error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div>
                <label for="username" :value="__('Name')" />
                <input class="w-[20rem]" id="username" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" placeholder="username" />
                <error :messages="$errors->get('username')" class="mt-2" />
            </div>
            <div>
                <label for="role" :value="__('admin')" />
                <input class="w-[20rem]" id="role" type="text" name="role" :value="old('role')" required autofocus autocomplete="role" placeholder="admin" />
                <error :messages="$errors->get('role')" class="mt-2" />
            </div>
            <div>
                <label for="password" :value="__('Name')" />
                <input class="w-[20rem]" id="password" type="text" name="password" :value="old('password')" required autofocus autocomplete="password" placeholder="password" />
                <error :messages="$errors->get('password')" class="mt-2 " />
            </div>
            <input type="submit" value="Register"  class="border rounded bg-sky-500 p-2 text-white w-[20rem] text-center cursor-pointer hover:bg-sky-400">
        </form>

        <a href="{{ route('login') }}" class="hover:text-blue-500">{{ __('Already registered?') }} </a>

    </section>

    <script>
        function fault(msg) {
            console.log('chec');
            document.getElementById('text').innerText = msg;
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
             alert.classList.add('transition');
             alert.classList.add('ease-out');

             alert.classList.add('duration-500');

        }
    </script>
</body>

</html>