@extends('layouts.guest')

@section('title', 'Register')

@section('content')
    <div class="max-w-md mx-auto mt-2 p-6 bg-white dark:bg-gray-800 rounded shadow ">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100 text-center">Register</h1>

        <form action="{{ route('register') }}" method="POST" novalidate>
            @csrf

            <x-input label="Name" name="name" type="text" placeholder="Your full name" required />

            <x-input label="Email" name="email" type="email" placeholder="email@example.com" required />

            <x-input label="Password" name="password" type="password" placeholder="********" required />

            <x-input label="Confirm Password" name="password_confirmation" type="password" placeholder="********"
                required />

            <x-button type="submit" class="w-full">Register</x-button>
        </form>

        <p class="mt-6 text-center text-gray-700 dark:text-gray-300">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline dark:text-blue-400">Login</a>
        </p>
    </div>
@endsection
