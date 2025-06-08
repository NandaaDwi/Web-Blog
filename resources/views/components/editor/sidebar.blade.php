@php
    $user = Auth::user();
@endphp

<aside id="sidebar"
    class="min-w-64 min-h-screen fixed inset-y-0 left-0 z-80 w-64 bg-white dark:bg-gray-900 shadow-lg transform -translate-x-full md:translate-x-0 md:static md:inset-auto transition-transform duration-300 ease-in-out border-r border-gray-200 dark:border-gray-700 flex flex-col"
    aria-label="Sidebar">
    <button
        class="absolute top-2 right-2 md:hidden text-gray-700 dark:text-gray-300 focus:outline-none hover:text-red-600 dark:hover:text-red-400"
        aria-label="Close sidebar" onclick="toggleSidebar()">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" viewBox="0 0 24 24">
            <path d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <div class="border-b border-gray-300 dark:border-gray-700 p-6 flex items-center space-x-3">
        <img src="{{ $user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
            alt="{{ $user->name }} Avatar" class="rounded-full w-10 h-10 object-cover" />
        <div>
            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">{{ ucfirst($user->role ?? 'Editor') }}</p>
        </div>
    </div>

    <nav class="flex-1 flex flex-col p-4 space-y-2 text-gray-700 dark:text-gray-300 text-sm overflow-y-auto">
        <a href="{{ route('editor.dashboard') }}" onclick="toggleSidebar()"
            class="group flex items-center px-4 py-2 rounded hover:bg-blue-100 dark:hover:bg-gray-700 transition
            {{ request()->routeIs('editor.dashboard') ? 'bg-blue-200 text-blue-900 font-semibold' : '' }}"
            title="Dashboard" aria-current="{{ request()->routeIs('editor.dashboard') ? 'page' : false }}">
            <i class="fas fa-tachometer-alt w-5 transition-colors group-hover:text-blue-700"></i>
            <span class="ml-3 font-medium">Dashboard</span>
        </a>

        <details class="group" {{ request()->routeIs('editor.articles.*') ? 'open' : '' }}>
            <summary
                class="flex items-center px-4 py-2 rounded hover:bg-blue-100 dark:hover:bg-gray-700 cursor-pointer transition select-none
                {{ request()->routeIs('editor.articles.*') ? 'bg-blue-200 text-blue-900 font-semibold' : '' }}"
                aria-haspopup="true" aria-expanded="{{ request()->routeIs('editor.articles.*') ? 'true' : 'false' }}">
                <i class="fas fa-newspaper w-5 transition-colors group-hover:text-blue-700"></i>
                <span class="ml-3 font-medium flex-1">Manajemen Artikel</span>
                <i
                    class="fas fa-chevron-down transition-transform group-open:rotate-180 text-gray-500 dark:text-gray-400"></i>
            </summary>
            <nav class="pl-10 mt-1 flex flex-col space-y-1">
                <a href="{{ route('editor.articles.index') }}" onclick="toggleSidebar()"
                    class="rounded px-2 py-1 hover:bg-blue-200 dark:hover:bg-gray-700 transition
                    {{ request()->routeIs('editor.articles.index') ? 'bg-blue-300 font-semibold' : '' }}"
                    aria-current="{{ request()->routeIs('editor.articles.index') ? 'page' : false }}">
                    Semua Artikel
                </a>
                <a href="{{ route('editor.articles.create') }}" onclick="toggleSidebar()"
                    class="rounded px-2 py-1 hover:bg-blue-200 dark:hover:bg-gray-700 transition
                    {{ request()->routeIs('editor.articles.create') ? 'bg-blue-300 font-semibold' : '' }}"
                    aria-current="{{ request()->routeIs('editor.articles.create') ? 'page' : false }}">
                    Tambah Artikel
                </a>
            </nav>
        </details>

        <a href="{{ route('editor.comments.index') }}" onclick="toggleSidebar()"
            class="group flex items-center px-4 py-2 rounded hover:bg-blue-100 dark:hover:bg-gray-700 transition
            {{ request()->routeIs('editor.comments.index') ? 'bg-blue-200 text-blue-900 font-semibold' : '' }}"
            title="Comments" aria-current="{{ request()->routeIs('editor.comments.index') ? 'page' : false }}">
            <i class="fas fa-comments w-5 transition-colors group-hover:text-blue-700"></i>
            <span class="ml-3 font-medium">Comments</span>
        </a>
    </nav>
</aside>
