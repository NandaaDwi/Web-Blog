@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
    <div class="container mx-auto max-w-2xl px-4 sm:px-6 lg:px-8 py-8">
        <nav class="mb-6">
            <ol class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                <li>
                    <a href="{{ route('admin.category.index') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                        <i class="fas fa-folder mr-1"></i>
                        Kategori
                    </a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right mx-2 text-xs"></i>
                    <span class="text-gray-900 dark:text-white font-medium">Edit</span>
                </li>
            </ol>
        </nav>

        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-2">
                <div class="p-2 bg-blue-600 rounded-lg">
                    <i class="fas fa-edit text-white text-xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Kategori</h1>
            </div>
            <p class="text-gray-600 dark:text-gray-400">Perbarui informasi kategori</p>
        </div>

        @if (session('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-400 mr-3"></i>
                    <p class="text-red-800 font-medium">{{ session('error') }}</p>
                </div>
            </div>
        @endif

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
            <form action="{{ route('admin.category.update', $category) }}" method="POST" class="p-6 sm:p-8 space-y-6">
                @csrf
                @method('PUT')

                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-tag text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Kategori saat ini:</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $category->name }}</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <label for="name" class="block text-lg font-semibold text-gray-900 dark:text-white">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-tag text-blue-600 dark:text-blue-400"></i>
                            <span>Nama Kategori</span>
                        </div>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('name') border-red-500 dark:border-red-400 @enderror"
                        placeholder="Masukkan nama kategori..." />
                    @error('name')
                        <p class="text-red-600 text-sm flex items-center mt-2">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('admin.category.index') }}"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transform hover:scale-105 transition-all duration-200 shadow-lg">
                        <i class="fas fa-save mr-2"></i>
                        Update Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection