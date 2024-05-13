<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- boxicons --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/5f361d4fee.js" crossorigin="anonymous"></script>

    {{-- Esto puede ser un array con una ruta para varios archivos --}}
    @vite('resources/js/script.js')

    {{-- Tailwind --}}
    @vite('resources/css/app.css')

    <title>@yield('title', 'PelisDB')</title>
</head>

<body class="font-sans bg-gray-900 text-white">
<nav class="border-b border-gray-800">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between py-6">
        <ul class="flex flex-col font-bold md:flex-row items-center">
            <li>
                <a href="{{ route('index') }}">
                    <img src="/img/PelisDB_logo_white.png" width="200" alt="PelisBD Logo">

            </li>
            <li class="md:ml-16 mt-3 md:mt-0">
                <a href="{{ route('index') }}" class="hover:text-gray-300">Movies</a>
            </li>
            <li class="md:ml-6 mt-3 md:mt-0">
                <a href="{{ route('actors.index') }}" class="hover:text-gray-300">Actors</a>
            </li>
        </ul>
        <div class="flex flex-col md:flex-row items-center">

            {{-- SEARCH BAR --}}

                <form method="POST">
                  <div class="relative text-gray-600 focus-within:text-gray-400">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                      <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                      </button>
                    </span>
                    <input type="search" name="q" class="py-2 text-sm text-white bg-gray-900 rounded-md pl-10 focus:outline-none focus:bg-white focus:text-gray-900" placeholder="Search..." autocomplete="off">
                  </div>
                </form>


            {{-- USER ICON --}}
            <div class="md:ml-4 mt-3 md:mt-0">
                <a href="#">
                    {{-- <img src="" alt="avatar" class="rounded-full w-8 h-8"> --}}
                    <i class='bx bx-user-circle bx-lg' style='color:#ffffff' ></i>
                </a>
            </div>

            {{-- LOGIN --}}
            <div class="md:ml-4 mt-3 md:mt-0">
                <a href="#">
                   Login
                </a>
            </div>

            {{-- REGISTER --}}
            <div class="md:ml-4 mt-3 md:mt-0">
                <a href="#">
                   Create account
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="container mx-auto px-4 py-6">
    @yield('content')
</div>

<footer class="border border-t border-gray-800">

    <div class="container mx-auto text-sm font-bold px-4 py-6">
        <ul class="flex flex-col md:flex-row items-center">
            <li class="md:ml-6 mt-3 md:mt-0">
                <a href="" class="hover:text-gray-300">About</a>
            </li>
            <li class="md:ml-6 mt-3 md:mt-0">
                <a href="" class="hover:text-gray-300">Contact</a>
            </li>
            <li class="md:ml-6 mt-3 md:mt-0">
                <a href="" class="hover:text-gray-300">SDASAD</a>
            </li>
            <li class="md:ml-6 mt-3 md:mt-0">
                <a href="" class="hover:text-gray-300">DSAASDAS</a>
            </li>
        </ul>
    </div>

    <div class="container mx-auto text-sm px-4 py-6">
        Powered by <a href="https://www.themoviedb.org/documentation/api" class="underline hover:text-gray-300">TMDb
            API</a>
    </div>
</footer>

</body>

</html>
