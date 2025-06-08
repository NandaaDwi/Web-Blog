@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <div class="max-w-md mx-auto mt-2 p-4 bg-white dark:bg-gray-800 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100 text-center">Login</h1>

        @if (session('error'))
            <x-alert type="error">{{ session('error') }}</x-alert>
        @endif

        <form action="{{ route('login') }}" method="POST" novalidate>
            @csrf

            <x-input label="Email" name="email" type="email" placeholder="email@example.com" required />

            <x-input label="Password" name="password" type="password" placeholder="********" required />

            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center text-gray-700 dark:text-gray-300">
                    <input type="checkbox" name="remember" class="mr-2" />
                    ingatkan saya
                </label>
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline dark:text-blue-400">Lupa password?</a>
            </div>

            <x-button type="submit" class="w-full">Login</x-button>
        </form>

        <p class="mt-6 text-center text-gray-700 dark:text-gray-300">
            Tidak punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline dark:text-blue-400">Daftar disini</a>
        </p>
    </div>
@endsection
