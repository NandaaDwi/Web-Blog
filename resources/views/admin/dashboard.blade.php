@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-2">
                <div class="p-2 bg-blue-600 rounded-lg">
                    <i class="fas fa-tachometer-alt text-white text-xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard Admin</h1>
            </div>
            <p class="text-gray-600 dark:text-gray-400">Ringkasan statistik dan informasi sistem</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total User</p>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-2">{{ $userCount }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Semua pengguna terdaftar</p>
                    </div>
                    <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-lg">
                        <i class="fas fa-users text-blue-600 dark:text-blue-400 text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Artikel</p>
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-2">{{ $articleCount }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Jumlah artikel</p>
                    </div>
                    <div class="p-3 bg-green-100 dark:bg-green-900 rounded-lg">
                        <i class="fas fa-newspaper text-green-600 dark:text-green-400 text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Komentar</p>
                        <p class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 mt-2">{{ $commentCount }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Jumlah komentar</p>
                    </div>
                    <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                        <i class="fas fa-comments text-yellow-600 dark:text-yellow-400 text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Kategori</p>
                        <p class="text-3xl font-bold text-purple-600 dark:text-purple-400 mt-2">{{ $categoryCount }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Jumlah kategori</p>
                    </div>
                    <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-lg">
                        <i class="fas fa-folder text-purple-600 dark:text-purple-400 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Aksi Cepat</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.articles.create') }}"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md hover:border-blue-300 dark:hover:border-blue-600 transition-all duration-200 group">
                    <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg mr-3 group-hover:bg-blue-200 dark:group-hover:bg-blue-800 transition-colors">
                        <i class="fas fa-plus text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Buat Artikel</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tulis artikel baru</p>
                    </div>
                </a>

                <a href="{{ route('admin.users.create') }}"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md hover:border-green-300 dark:hover:border-green-600 transition-all duration-200 group">
                    <div class="p-2 bg-green-100 dark:bg-green-900 rounded-lg mr-3 group-hover:bg-green-200 dark:group-hover:bg-green-800 transition-colors">
                        <i class="fas fa-user-plus text-green-600 dark:text-green-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Tambah User</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Buat user baru</p>
                    </div>
                </a>

                <a href="{{ route('admin.category.create') }}"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md hover:border-purple-300 dark:hover:border-purple-600 transition-all duration-200 group">
                    <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg mr-3 group-hover:bg-purple-200 dark:group-hover:bg-purple-800 transition-colors">
                        <i class="fas fa-folder-plus text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Buat Kategori</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tambah kategori baru</p>
                    </div>
                </a>

                <a href="{{ route('admin.logs.index') }}"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md hover:border-yellow-300 dark:hover:border-yellow-600 transition-all duration-200 group">
                    <div class="p-2 bg-yellow-100 dark:bg-yellow-900 rounded-lg mr-3 group-hover:bg-yellow-200 dark:group-hover:bg-yellow-800 transition-colors">
                        <i class="fas fa-history text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Lihat Log</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Pantau aktivitas</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection