@extends('layouts.user')

@section('title', 'Beranda')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="text-center mb-12">
            <div class="inline-flex items-center space-x-3 mb-4">
                <div class="p-2 bg-blue-600 rounded-lg animate-bounce">
                    <i class="fas fa-newspaper text-white text-xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Artikel Terbaru</h2>
            </div>
            <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Jelajahi koleksi artikel terbaru kami yang penuh dengan wawasan, tips, dan cerita menarik.
            </p>
        </div>

        @if($articles->count() > 0)
        <div x-data="{ keyword: '', selectedCategory: '' }">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-search mr-2 text-blue-600 dark:text-blue-400"></i>
                            Cari Artikel
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                id="search"
                                x-model="keyword" 
                                placeholder="Cari berdasarkan judul atau konten..."
                                class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-filter mr-2 text-blue-600 dark:text-blue-400"></i>
                            Filter Kategori
                        </label>
                        <select 
                            id="category"
                            x-model="selectedCategory"
                            class="w-full pl-4 pr-10 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200"
                        >
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ strtolower($category->name) }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4 flex flex-wrap gap-2" x-show="keyword || selectedCategory">
                    <template x-if="keyword">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                            <i class="fas fa-search mr-1"></i>
                            <span x-text="'Pencarian: ' + keyword"></span>
                            <button @click="keyword = ''" class="ml-2 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200">
                                <i class="fas fa-times"></i>
                            </button>
                        </span>
                    </template>
                    <template x-if="selectedCategory">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                            <i class="fas fa-tag mr-1"></i>
                            <span x-text="'Kategori: ' + selectedCategory"></span>
                            <button @click="selectedCategory = ''" class="ml-2 text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-200">
                                <i class="fas fa-times"></i>
                            </button>
                        </span>
                    </template>
                </div>
            </div>

            <div id="articles" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach ($articles as $article)
                    @php
                        $textContent = strtolower($article->title . ' ' . strip_tags($article->content));
                        $categoryNames = $article->categories->pluck('name')->map(fn($n) => strtolower($n))->implode(',');
                    @endphp

                    <article
                        x-show="('{{ $textContent }}'.includes(keyword.toLowerCase()) &&
                                ('{{ $categoryNames }}'.includes(selectedCategory.toLowerCase()) || selectedCategory === ''))"
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl group"
                    >
                        <div class="relative h-48 overflow-hidden">
                            @if($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 ease-in-out">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-white text-4xl"></i>
                                </div>
                            @endif

                            <div class="absolute top-3 right-3">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-black bg-opacity-50 text-white backdrop-blur-sm shadow">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min
                                </span>
                            </div>

                            @if($article->categories->isNotEmpty())
                                <div class="absolute top-3 left-3">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-600 text-white shadow">
                                        <i class="fas fa-tag mr-1"></i>
                                        {{ $article->categories->first()->name }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 overflow-hidden line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                {{ $article->title }}
                            </h3>

                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-3">
                                <div class="flex items-center mr-4">
                                    <div class="w-6 h-6 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mr-2">
                                        <i class="fas fa-user text-blue-600 dark:text-blue-400 text-xs"></i>
                                    </div>
                                    <span class="font-medium">{{ $article->user->name }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    <span>{{ $article->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            @if($article->categories->count() > 1)
                                <div class="mb-3 flex flex-wrap gap-2">
                                    @foreach ($article->categories->skip(1) as $cat)
                                        <span class="text-xs px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-full">{{ $cat->name }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <p class="text-gray-600 dark:text-gray-300 text-sm overflow-hidden line-clamp-3 mb-4 leading-relaxed">
                                {{ Str::limit(strip_tags($article->content), 120) }}
                            </p>

                            <a href="{{ route('user.articles.show', $article->slug) }}"
                               class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transform hover:scale-105 transition-all duration-200 shadow-lg">
                                <span>Baca Selengkapnya</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div 
                x-show="!document.querySelectorAll('#articles article[style*=\'display: block\']').length && (keyword || selectedCategory)"
                class="text-center py-16 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 mb-12"
            >
                <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-search text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Tidak ada artikel ditemukan</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Coba ubah kata kunci pencarian atau filter kategori</p>
                <button @click="keyword = ''; selectedCategory = ''" 
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200">
                    <i class="fas fa-refresh mr-2"></i>
                    Reset Filter
                </button>
            </div>
        </div>
        @else
            <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 mb-12">
                <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-newspaper text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Belum ada artikel</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Artikel akan segera hadir. Pantau terus untuk update terbaru!</p>
            </div>
        @endif

        @guest
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 dark:from-blue-800 dark:to-blue-900 rounded-xl shadow-lg p-8 text-center">
                <div class="max-w-2xl mx-auto">
                    <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-pen-nib text-white text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-4">Bergabung dengan Kami</h2>
                    <p class="text-blue-100 mb-6">Daftar sekarang untuk mendapatkan akses penuh ke semua artikel, ikut berdiskusi, dan berbagi pengalaman Anda.</p>
                    <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 text-sm font-semibold text-blue-600 bg-white rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 transform hover:scale-105 transition-all duration-200 shadow-lg">
                            <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 text-sm font-medium text-white border border-white rounded-lg hover:bg-white hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 transition-all duration-200">
                            <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-gradient-to-r from-green-600 to-green-800 dark:from-green-800 dark:to-green-900 rounded-xl shadow-lg p-8 text-center">
                <div class="max-w-2xl mx-auto">
                    <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-heart text-white text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-4">
                        Selamat Datang Kembali, {{ Auth::user()->name }}!
                    </h2>
                    <p class="text-green-100 mb-6">
                        Terima kasih telah menjadi bagian dari komunitas kami. Jelajahi artikel terbaru dan jangan lupa berbagi pendapat Anda.
                    </p>
                    <a href="#articles"
                       onclick="document.querySelector('#articles').scrollIntoView({behavior: 'smooth'})"
                       class="inline-flex items-center px-6 py-3 text-sm font-semibold text-green-600 bg-white rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-green-600 transform hover:scale-105 transition-all duration-200 shadow-lg">
                        <i class="fas fa-arrow-down mr-2"></i> Lihat Artikel
                    </a>
                </div>
            </div>
        @endguest
    </div>
</div>
@endsection