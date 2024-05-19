@extends('layouts.main')

@section('content')
    <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-4 text-gray-700">Login</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" id="email" name="email" required
                       class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-700">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700">Password:</label>
                <input type="password" id="password" name="password" required
                       class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-700">
            </div>
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Login
            </button>
        </form>

        <p class="mt-4 text-gray-700 text-sm">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700">Register here</a>
        </p>
    </div>
@endsection
