<nav x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', dropdownOpen: false }" x-init="if (darkMode) document.documentElement.classList.add('dark')"
    class="bg-white dark:bg-gray-800 shadow-lg border-b border-gray-200 dark:border-gray-700 px-4 py-3 flex justify-between items-center fixed w-full md:static z-20 min-h-[72px]">

    <button @click="$dispatch('toggle-sidebar')"
        class="block sm:hidden p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 shadow-sm"
        aria-label="Toggle sidebar">
        <i class="fas fa-bars text-lg"></i>
    </button>

    <div class="hidden sm:flex items-center space-x-3">
        <div class="p-2 bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg">
            <i class="fas fa-tachometer-alt text-white text-lg"></i>
        </div>
        <a href="{{ Auth::user()->role === 'editor' ? route('editor.dashboard') : route('admin.dashboard') }}"
            class="text-xl font-bold text-gray-900 dark:text-white">
            {{ Auth::user()->role === 'editor' ? 'Editor Panel' : 'Admin Panel' }}
        </a>

    </div>

    <div class="flex items-center space-x-3">
        <div>
            <button
                @click="darkMode = !darkMode; 
                            document.documentElement.classList.toggle('dark');
                            localStorage.setItem('darkMode', darkMode)"
                class="p-2.5 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 shadow-sm border border-gray-200 dark:border-gray-600"
                aria-label="Toggle Dark Mode">
                <i :class="darkMode ? 'fas fa-sun text-lg' : 'fas fa-moon text-lg'"></i>
            </button>
        </div>

        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <button @click="open = !open"
                class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 border border-gray-200 dark:border-gray-600 shadow-sm"
                aria-haspopup="true" :aria-expanded="open.toString()">

                <div
                    class="w-8 h-8 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>

                <div class="hidden sm:block text-left">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 capitalize">{{ Auth::user()->role ?? 'User' }}
                    </p>
                </div>

                <i
                    :class="open ? 'fas fa-chevron-down text-xs text-gray-500 dark:text-gray-400 rotate-180 transition' :
                        'fas fa-chevron-down text-xs text-gray-500 dark:text-gray-400 transition'"></i>
            </button>

            <div x-show="open" x-transition
                class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 py-2 z-50"
                @click.away="open = false">
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-user text-blue-600 dark:text-blue-400 text-xs"></i>
                    </div>
                    <div>
                        <p class="font-medium">Profile</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Kelola profil Anda</p>
                    </div>
                </a>

                <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>

                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-200">
                        <div
                            class="w-8 h-8 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-sign-out-alt text-red-600 dark:text-red-400 text-xs"></i>
                        </div>
                        <div class="text-left">
                            <p class="font-medium">Keluar</p>
                            <p class="text-xs text-red-500 dark:text-red-400">Logout dari sistem</p>
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
