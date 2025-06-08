@php
  $user = Auth::user();
@endphp

<div id="sidebar-container" class="fixed top-0 h-screen md:flex z-100">
  <aside id="sidebar"
    class="fixed inset-y-0 left-0 z-30 w-64 bg-white dark:bg-gray-800 shadow-lg transform -translate-x-full md:translate-x-0 md:static md:inset-auto transition-transform duration-300 ease-in-out border-r border-gray-900 flex flex-col"
    x-data="{ openCategory: {{ request()->routeIs('admin.category.*') ? 'true' : 'false' }}, openArticles: {{ request()->routeIs('admin.articles.*') ? 'true' : 'false' }} }">

    <button
      class="absolute top-2 right-2 md:hidden text-gray-700 dark:text-gray-300 focus:outline-none hover:text-red-600 dark:hover:text-red-400"
      aria-label="Close sidebar" onclick="toggleSidebar()">
      <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
        stroke-linejoin="round" viewBox="0 0 24 24">
        <path d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>

    <div class="border-b border-gray-200 dark:border-gray-700 p-6">
      <div class="flex items-center space-x-3">
        <div class="w-12 h-12 rounded-full flex items-center justify-center shadow-lg">
          <img src="{{ $user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
            alt="{{ $user->name }} Avatar" class="rounded-full w-10 h-10">
        </div>
        <div class="flex-1 min-w-0">
          <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $user->name }}</p>
          <p class="text-xs text-gray-500 dark:text-gray-400 capitalize">{{ ucfirst($user->role ?? 'Editor') }}</p>
        </div>
      </div>
    </div>

    <nav class="flex-1 flex flex-col p-4 space-y-2 text-gray-700 dark:text-gray-300 text-sm overflow-y-auto">

      <a href="{{ route('admin.dashboard') }}" onclick="toggleSidebar()"
        class="group flex items-center px-4 py-2 rounded hover:bg-blue-100 dark:hover:bg-gray-700 transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-200 text-blue-900 font-semibold' : '' }}"
        title="Dashboard">
        <i class="fas fa-tachometer-alt w-5 transition-colors group-hover:text-blue-700"></i>
        <span class="ml-3 font-medium">Dashboard</span>
      </a>

      <a href="{{ route('admin.users.index') }}" onclick="toggleSidebar()"
        class="group flex items-center px-4 py-2 rounded hover:bg-blue-100 dark:hover:bg-gray-700 transition relative {{ request()->routeIs('admin.users.*') ? 'bg-blue-200 text-blue-900 font-semibold' : '' }}"
        title="Manajemen User">
        <i class="fas fa-users w-5 transition-colors group-hover:text-blue-700"></i>
        <span class="ml-3 font-medium">Manajemen User</span>
      </a>

      <div>
        <div @click="openCategory = !openCategory"
             class="flex items-center px-4 py-2 rounded hover:bg-blue-100 dark:hover:bg-gray-700 cursor-pointer transition select-none {{ request()->routeIs('admin.category.*') ? 'bg-blue-200 text-blue-900 font-semibold' : '' }}">
          <i class="fas fa-tags w-5 transition-colors group-hover:text-blue-700"></i>
          <span class="ml-3 font-medium flex-1">Manajemen Kategori</span>
          <i :class="{ 'rotate-180': openCategory }"
             class="fas fa-chevron-down transition-transform text-gray-500 dark:text-gray-400"></i>
        </div>
        <nav x-show="openCategory" x-transition.duration.300ms class="pl-10 mt-1 flex flex-col space-y-1">
          <a href="{{ route('admin.category.index') }}"
            class="rounded px-2 py-1 hover:bg-blue-200 dark:hover:bg-gray-700 transition {{ request()->routeIs('admin.category.index') ? 'bg-blue-300 font-semibold' : '' }}">
            Semua Kategori
          </a>
          <a href="{{ route('admin.category.create') }}"
            class="rounded px-2 py-1 hover:bg-blue-200 dark:hover:bg-gray-700 transition {{ request()->routeIs('admin.category.create') ? 'bg-blue-300 font-semibold' : '' }}">
            Tambah Kategori
          </a>
        </nav>
      </div>

      <div>
        <div @click="openArticles = !openArticles"
             class="flex items-center px-4 py-2 rounded hover:bg-blue-100 dark:hover:bg-gray-700 cursor-pointer transition select-none {{ request()->routeIs('admin.articles.*') ? 'bg-blue-200 text-blue-900 font-semibold' : '' }}">
          <i class="fas fa-newspaper w-5 transition-colors group-hover:text-blue-700"></i>
          <span class="ml-3 font-medium flex-1">Manajemen Artikel</span>
          <i :class="{ 'rotate-180': openArticles }"
             class="fas fa-chevron-down transition-transform text-gray-500 dark:text-gray-400"></i>
        </div>
        <nav x-show="openArticles" x-transition.duration.300ms class="pl-10 mt-1 flex flex-col space-y-1">
          <a href="{{ route('admin.articles.index') }}"
            class="rounded px-2 py-1 hover:bg-blue-200 dark:hover:bg-gray-700 transition {{ request()->routeIs('admin.articles.index') ? 'bg-blue-300 font-semibold' : '' }}">
            Semua Artikel
          </a>
          <a href="{{ route('admin.articles.create') }}"
            class="rounded px-2 py-1 hover:bg-blue-200 dark:hover:bg-gray-700 transition {{ request()->routeIs('admin.articles.create') ? 'bg-blue-300 font-semibold' : '' }}">
            Tambah Artikel
          </a>
        </nav>
      </div>

      <a href="{{ route('admin.comments.index') }}" onclick="toggleSidebar()"
        class="group flex items-center px-4 py-2 rounded hover:bg-blue-100 dark:hover:bg-gray-700 transition relative {{ request()->routeIs('admin.comments.*') ? 'bg-blue-200 text-blue-900 font-semibold' : '' }}"
        title="Manajemen Komentar">
        <i class="fas fa-comments w-5 transition-colors group-hover:text-blue-700"></i>
        <span class="ml-3 font-medium">Manajemen Komentar</span>
      </a>

      <a href="{{ route('admin.logs.index') }}" onclick="toggleSidebar()"
        class="group flex items-center px-4 py-2 rounded hover:bg-blue-100 dark:hover:bg-gray-700 transition {{ request()->routeIs('admin.logs.*') ? 'bg-blue-200 text-blue-900 font-semibold' : '' }}"
        title="Manajemen Aktivitas">
        <i class="fas fa-file-alt w-5 transition-colors group-hover:text-blue-700"></i>
        <span class="ml-3 font-medium">Manajemen Aktivitas</span>
      </a>
    </nav>
  </aside>
</div>
