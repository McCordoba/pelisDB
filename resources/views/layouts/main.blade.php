<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/5f361d4fee.js" crossorigin="anonymous"></script>

    @vite(['resources/js/script.js', 'resources/js/trailerModal.js', 'resources/css/app.css', 'resources/css/style.css'])

    <title>@yield('title', 'PelisDB')</title>
</head>

<body class="font-sans">
<nav class="border-b border-gray-500 font-semibold">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between py-6">
        <ul class="flex flex-col md:flex-row items-center">
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
            <livewire:search-bar/>

            <!-- Check if the user is NOT authenticated -->
            @guest
                {{-- LOGIN --}}
                <div class="md:ml-4 mt-3 md:mt-0">
                    <a href="{{ route('login') }}" class="hover:text-gray-300">Login</a>
                </div>

                {{-- REGISTER --}}
                <div class="md:ml-4 mt-3 md:mt-0">
                    <a href="{{ route('register') }}" class="hover:text-gray-300">Create account</a>
                </div>
            @endguest

            <!-- Check if the user is authenticated -->
            @auth
                {{-- USER ICON --}}
                <div class="md:ml-4 mt-3 md:mt-0">
                    <a href="{{ route('users.show', auth()->user()->id) }}">
                        @if ($user->image)
                            <img src="{{ asset('storage/' . $user->image) }}" alt="avatar" class="rounded-full w-12 h-12">
                        @else
                            <i class="fa-regular fa-circle-user fa-2xl" style="color: #ffffff;"></i>
                        @endif
                    </a>
                </div>

                {{-- LOG OUT --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logOut ml-4 flex items-center rounded w-20 h-12 justify-center transition ease-in-out duration-150">
                        <i class="fa-solid fa-power-off"></i>
                        <span class="ml-2">Logout</span>
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<div class="container mx-auto px-4 py-6">
    @yield('content')
</div>

<footer class="border-t border-t-gray-500">
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
