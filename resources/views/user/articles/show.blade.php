@extends('layouts.user')

@section('title', $article->title)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <nav class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                <i class="fas fa-home mr-1"></i>
                Beranda
            </a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-900 dark:text-white">{{ $article->title }}</span>
        </nav>

        <div class="max-w-4xl mx-auto">
            <article class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden mb-8">
                @if ($article->thumbnail)
                    <div class="relative h-64 sm:h-80 lg:h-96 overflow-hidden">
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>
                @endif

                <div class="p-6 sm:p-8">
                    @if($article->categories && $article->categories->count() > 0)
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($article->categories as $category)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                        {{ $article->title }}
                    </h1>

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 dark:border-gray-700 pb-6 mb-8">
                        <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $article->user->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Penulis</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span>{{ $article->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-2"></i>
                                <span>{{ $article->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-comments mr-2"></i>
                                <span>{{ $article->comments->count() }} komentar</span>
                            </div>
                        </div>
                    </div>

                    <div class="prose prose-lg dark:prose-invert max-w-none">
                        {!! $article->content !!}
                    </div>
                </div>
            </article>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 sm:p-8">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                        <i class="fas fa-comments text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Komentar ({{ $article->comments->count() }})
                    </h2>
                </div>

                @auth
                    <div class="mb-8 p-6 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                            <i class="fas fa-pen mr-2 text-blue-600 dark:text-blue-400"></i>
                            Tulis Komentar
                        </h3>
                        <form method="POST" action="{{ route('user.articles.comment', $article->slug) }}">
                            @csrf
                            <div class="mb-4">
                                <textarea name="body" rows="4" required
                                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-none"
                                          placeholder="Bagikan pendapat Anda tentang artikel ini...">{{ old('body') }}</textarea>
                                @error('body')
                                    <p class="text-red-600 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transform hover:scale-105 transition-all duration-200 shadow-lg">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Kirim Komentar
                            </button>
                        </form>
                    </div>
                @else
                    <div class="mb-8 p-6 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800 text-center">
                        <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-sign-in-alt text-blue-600 dark:text-blue-400 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Ingin berkomentar?</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">Login</a> 
                            untuk dapat memberikan komentar pada artikel ini
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-4">
                            <a href="{{ route('login') }}" 
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" 
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 dark:text-blue-400 bg-white dark:bg-gray-800 border border-blue-600 dark:border-blue-400 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200">
                                <i class="fas fa-user-plus mr-2"></i>
                                Daftar
                            </a>
                        </div>
                    </div>
                @endauth

                <div class="space-y-6">
                    @forelse ($article->comments as $comment)
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-6 last:border-b-0 last:pb-0">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $comment->user->name }}
                                        </h4>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">•</span>
                                        <time class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </time>
                                    </div>
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3 border border-gray-200 dark:border-gray-600">
                                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                            {{ $comment->body }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-comments text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Belum ada komentar</h3>
                            <p class="text-gray-600 dark:text-gray-400">Jadilah yang pertama memberikan komentar pada artikel ini</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection