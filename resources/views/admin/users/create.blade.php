@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
    <div class="container mx-auto max-w-2xl px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-2">
                <div class="p-2 bg-blue-600 rounded-lg">
                    <i class="fas fa-user-plus text-white text-xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Tambah User Baru</h1>
            </div>
            <p class="text-gray-600 dark:text-gray-400">Buat akun pengguna baru untuk sistem</p>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-400 mr-3"></i>
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 rounded-lg shadow-sm">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-red-400 mr-3 mt-1"></i>
                    <div>
                        <p class="text-red-800 font-medium mb-2">Terjadi kesalahan:</p>
                        <ul class="list-disc list-inside space-y-1 text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
                @csrf

                <div class="space-y-4">
                    <label for="name" class="block text-lg font-semibold text-gray-900 dark:text-white">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-user text-blue-600 dark:text-blue-400"></i>
                            <span>Nama Lengkap</span>
                        </div>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('name') border-red-500 dark:border-red-400 @enderror"
                        placeholder="Masukkan nama lengkap..." />
                    @error('name')
                        <p class="text-red-600 text-sm flex items-center mt-2">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <label for="email" class="block text-lg font-semibold text-gray-900 dark:text-white">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-envelope text-blue-600 dark:text-blue-400"></i>
                            <span>Email</span>
                        </div>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('email') border-red-500 dark:border-red-400 @enderror"
                        placeholder="Masukkan alamat email..." />
                    @error('email')
                        <p class="text-red-600 text-sm flex items-center mt-2">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <label for="role" class="block text-lg font-semibold text-gray-900 dark:text-white">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-user-shield text-blue-600 dark:text-blue-400"></i>
                            <span>Role</span>
                        </div>
                    </label>
                    <select name="role" id="role" required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('role') border-red-500 dark:border-red-400 @enderror">
                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih role pengguna</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="editor" {{ old('role') == 'editor' ? 'selected' : '' }}>Editor</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User Biasa</option>
                    </select>
                    @error('role')
                        <p class="text-red-600 text-sm flex items-center mt-2">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <label for="password" class="block text-lg font-semibold text-gray-900 dark:text-white">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-lock text-blue-600 dark:text-blue-400"></i>
                            <span>Password</span>
                        </div>
                    </label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('password') border-red-500 dark:border-red-400 @enderror"
                        placeholder="Masukkan password..." />
                    @error('password')
                        <p class="text-red-600 text-sm flex items-center mt-2">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <label for="password_confirmation" class="block text-lg font-semibold text-gray-900 dark:text-white">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-lock text-blue-600 dark:text-blue-400"></i>
                            <span>Konfirmasi Password</span>
                        </div>
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                        placeholder="Konfirmasi password..." />
                </div>

                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('admin.users.index') }}"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transform hover:scale-105 transition-all duration-200 shadow-lg">
                        <i class="fas fa-save mr-2"></i>
                        Simpan User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection