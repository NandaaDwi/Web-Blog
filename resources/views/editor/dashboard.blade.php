@extends('layouts.editor')  

@section('title', 'Dashboard Editor')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-2">
                <div class="p-2 bg-blue-600 rounded-lg">
                    <i class="fas fa-tachometer-alt text-white text-xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard Editor</h1>
            </div>
            <p class="text-gray-600 dark:text-gray-400">Selamat datang kembali! Kelola artikel dan konten Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Artikel</p>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-2">{{ $totalArticles }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Artikel yang Anda tulis</p>
                    </div>
                    <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-lg">
                        <i class="fas fa-newspaper text-blue-600 dark:text-blue-400 text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Komentar</p>
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-2">{{ $totalComments }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Komentar di artikel Anda</p>
                    </div>
                    <div class="p-3 bg-green-100 dark:bg-green-900 rounded-lg">
                        <i class="fas fa-comments text-green-600 dark:text-green-400 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Aksi Cepat</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <a href="{{ route('editor.articles.create') }}"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md hover:border-blue-300 dark:hover:border-blue-600 transition-all duration-200 group">
                    <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg mr-3 group-hover:bg-blue-200 dark:group-hover:bg-blue-800 transition-colors">
                        <i class="fas fa-plus text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Tulis Artikel</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Buat artikel baru</p>
                    </div>
                </a>

                <a href="{{ route('editor.articles.index') }}"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md hover:border-green-300 dark:hover:border-green-600 transition-all duration-200 group">
                    <div class="p-2 bg-green-100 dark:bg-green-900 rounded-lg mr-3 group-hover:bg-green-200 dark:group-hover:bg-green-800 transition-colors">
                        <i class="fas fa-list text-green-600 dark:text-green-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Kelola Artikel</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Edit artikel Anda</p>
                    </div>
                </a>

                <a href="{{ route('editor.comments.index') }}"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md hover:border-yellow-300 dark:hover:border-yellow-600 transition-all duration-200 group">
                    <div class="p-2 bg-yellow-100 dark:bg-yellow-900 rounded-lg mr-3 group-hover:bg-yellow-200 dark:group-hover:bg-yellow-800 transition-colors">
                        <i class="fas fa-comments text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Kelola Komentar</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Moderasi komentar</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg">
                        <i class="fas fa-clock text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Artikel Terbaru</h2>
                </div>
            </div>
            <div class="p-6">
                @forelse ($recentArticles as $article)
                    <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-gray-200 dark:border-gray-700' : '' }}">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg flex items-center justify-center">
                                <i class="fas fa-newspaper text-white text-sm"></i>
                            </div>
                            <div>
                                <a href="{{ route('editor.articles.edit', $article->id) }}" 
                                    class="text-sm font-medium text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    {{ $article->title }}
                                </a>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $article->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            @if($article->is_published)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Published
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                    <i class="fas fa-clock mr-1"></i>
                                    Draft
                                </span>
                            @endif
                            <a href="{{ route('editor.articles.edit', $article->id) }}" 
                                class="p-1 text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-newspaper text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada artikel</p>
                        <p class="text-sm text-gray-400 dark:text-gray-500 mb-4">Mulai menulis artikel pertama Anda</p>
                        <a href="{{ route('editor.articles.create') }}" 
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200">
                            <i class="fas fa-plus mr-2"></i>
                            Tulis Artikel
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection