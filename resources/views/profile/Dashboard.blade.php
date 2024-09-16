<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css'])

</head>

<body>
    <!--HEADER-->
    <section id="navigation">

        <!-- Success -->
        @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                success("{{session('success')}}");
            })
        </script>
        @endif



        @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                fault("{{session('error')}}");
            })
        </script>

        @endif



        <!-- Errors -->
        <section class=" absolute -translate-y-[10vh] bg-red-500 w-full h-[10vh]  flex justify-center items-center" id='er-msg-container'>
            <h2 class="text-xl text-white" id="er-msg">error message</h2>
        </section>

        <section class=" absolute  -translate-y-[10vh]  bg-green-500 w-full h-[10vh]  flex justify-center items-center" id='s-msg-container'>
            <h2 class="text-xl text-white" id="s-msg">success message</h2>
        </section>

        <nav class="bg-slate-800 w-full h-[10vh] flex justify-between p-2 items-center">
            <h1 class="text-white text-xl">
           
                @if (session('firstname'))
                Admin: {{ session('firstname') }} 
                @endif
               

            </h1>
            <div>
                <ul class="flex gap-5">
                    <li><button class="bg-sky-500 text-white p-3 rounded w-[8rem] hover:bg-sky-400" onclick="showCategory()">Categories</button></li>
                    <li><button class="bg-sky-500 text-white p-3 rounded w-[8rem] hover:bg-sky-400" onclick="showItems()">Items</button></li>
                </ul>
            </div>
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">
                        <button class="bg-red-500 text-white p-3 rounded w-[8rem] hover:bg-red-400">Log out</button>
                    </x-dropdown-link>
                </form>
            </div>
        </nav>
    </section>


    <!--BODY  -->
    <section class="border  h-[90vh] ">
        @include('components.items')
        @include('components.category')

    </section>

    <script>
        function fault(msg) {
            document.getElementById('er-msg').innerText = msg;
            const alert = document.getElementById('er-msg-container');


            alert.classList.replace('-translate-y-[10vh]', 'translate-y-0');
            alert.classList.add('transition');
            alert.classList.add('ease-out');
            alert.classList.add('duration-500');
            setTimeout(hide, 3000);
        }

        function success(msg) {
            document.getElementById('s-msg').innerHTML = msg;

            const alert = document.getElementById('s-msg-container');
            alert.classList.replace('-translate-y-[10vh]', 'translate-y-0');
            alert.classList.add('transition');
            alert.classList.add('ease-out');
            alert.classList.add('duration-500');
            setTimeout(hide, 3000);
        }

        function hide() {
            const alert_success = document.getElementById('s-msg-container');
            const alert_error = document.getElementById('er-msg-container');
            alert_success.classList.replace('translate-y-0', '-translate-y-[10vh]');
            alert_error.classList.replace('translate-y-0', '-translate-y-[10vh]');
        }
    </script>
</body>

</html>