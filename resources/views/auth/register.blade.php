@extends('layouts.main')

@section('content')
    <div class="container mx-auto py-16 flex justify-center items-center">
        <div class="w-full max-w-md bg-gray-800 rounded-lg overflow-hidden shadow-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Register</h1>
            <form method="POST" action="{{ route('register') }}" class="flex flex-col">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-300">Username</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="mt-1 block w-full rounded-md px-4 py-1 bg-gray-800 shadow-sm focus:border-[var(--two)] focus:ring focus:outline-none focus:ring-[var(--two)] focus:ring-opacity-50"
                           placeholder="username">
                    @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-300">Email address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="mt-1 block w-full rounded-md px-4 py-1 bg-gray-800 shadow-sm focus:border-[var(--two)] focus:ring focus:outline-none focus:ring-[var(--two)] focus:ring-opacity-50"
                           placeholder="email@email.com">
                    @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-300">Password</label>
                    <input type="password" id="password" name="password" required
                           class="mt-1 block w-full rounded-md px-4 py-1 bg-gray-800 shadow-sm focus:border-[var(--two)] focus:ring focus:outline-none focus:ring-[var(--two)] focus:ring-opacity-50"
                           placeholder="*********">
                    @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-300">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="mt-1 block w-full rounded-md px-4 py-1 bg-gray-800 shadow-sm focus:border-[var(--two)] focus:ring focus:outline-none focus:ring-[var(--two)] focus:ring-opacity-50"
                           placeholder="*********">
                    @error('password_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"
                        class="bg-[var(--two)] hover:bg-[var(--three)] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Register
                </button>
            </form>

            <p class="mt-4 text-gray-300 text-sm">
                Already have an account?
                <a href="{{ route('login') }}" class="text-[var(--two)] hover:text-[var(--three)]">Login here</a>
            </p>
        </div>
    </div>
@endsection
