@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-md mx-auto bg-gray-800 rounded-lg overflow-hidden shadow-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Edit Profile</h1>
            @if (session('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('users.update') }}" enctype="multipart/form-data" class="flex flex-col">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-300">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                           class="mt-1 block w-full rounded-md px-4 py-1 bg-gray-800 shadow-sm focus:border-[var(--two)] focus:ring focus:outline-none focus:ring-[var(--two)] focus:ring-opacity-50">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-300">Email address</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="mt-1 block w-full rounded-md px-4 py-1 bg-gray-800 shadow-sm focus:border-[var(--two)] focus:ring focus:outline-none focus:ring-[var(--two)] focus:ring-opacity-50">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-300">Profile Image</label>
                    <input type="file" id="image" name="image"
                           class="mt-1 block w-full rounded-md px-4 py-1 bg-gray-800 shadow-sm focus:border-[var(--two)] focus:ring focus:outline-none focus:ring-[var(--two)] focus:ring-opacity-50">
                    @error('image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    @if ($user->image)
                        <div class="mt-4">
                            <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" class="rounded-full w-32 h-32">
                        </div>
                    @endif
                </div>
                <button type="submit"
                        class="bg-[var(--two)] hover:bg-[var(--three)] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update
                </button>
            </form>
        </div>
    </div>
@endsection
