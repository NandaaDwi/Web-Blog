@extends('layouts.guest')

@section('title', 'Forgot Password')

@section('content')
    <div class="max-w-md mx-auto mt-20 p-6 bg-white dark:bg-gray-800 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100 text-center">Forgot Password</h1>

        @if (session('status'))
            <x-alert type="success">{{ session('status') }}</x-alert>
        @endif

        <form action="{{ route('password.email') }}" method="POST" novalidate>
            @csrf

            <x-input label="Email" name="email" type="email" placeholder="email@example.com" required />

            <x-button type="submit" class="w-full">Send Password Reset Link</x-button>
        </form>

        <p class="mt-6 text-center text-gray-700 dark:text-gray-300">
            Remember your password?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline dark:text-blue-400">Login here</a>
        </p>
    </div>
@endsection
