<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/5f361d4fee.js" crossorigin="anonymous"></script>

    {{-- https://infinite-scroll.com/ --}}
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>

    @vite(['resources/js/trailerModal.js', 'resources/js/buttons.js', 'resources/js/readMore.js', 'resources/css/app.css',  'resources/css/style.css'])

    <title>@yield('title', 'PelisDB')</title>
</head>

<body class="font-sans">
<nav class="border-b border-gray-500 font-semibold text-lg">
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
                            <img src="{{ asset('storage/' . $user->image) }}" alt="avatar"
                                 class="rounded-full w-16 h-16">
                        @else
                            <i class="fa-regular fa-circle-user fa-2xl" style="color: #ffffff;"></i>
                        @endif
                    </a>
                </div>

                {{-- LOG OUT --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logOut ml-4 flex items-center rounded w-24 h-12 justify-center transition ease-in-out duration-150 p-2 space-x-2">
                        <i class="fa-solid fa-power-off"></i>
                        <span>Logout</span>
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
    <div class="container mx-auto text-lg font-bold px-4 py-6">
        <ul class="flex flex-col md:flex-row items-center">
            <li class="md:ml-6 mt-3 md:mt-0">
                <a href="{{ route('about') }}" class="hover:text-gray-300">About</a>
            </li>
        </ul>
    </div>

    <div class="container mx-auto text-sm px-4 py-6">
        Powered by <a href="https://www.themoviedb.org/documentation/api" class="underline">TMDb
            API</a>
    </div>
</footer>

@yield('scripts')
</body>

</html>
