<nav class="bg-white dark:bg-gray-800 shadow-lg border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-3">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="p-2 bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg group-hover:from-blue-700 group-hover:to-blue-800 transition-all duration-200">
                        <i class="fas fa-blog text-white text-lg"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        BlogApp
                    </span>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" 
                    class="flex items-center space-x-2 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200 {{ request()->routeIs('home') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20' : '' }}">
                    <i class="fas fa-home"></i>
                    <span class="font-medium">Beranda</span>
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <div x-data="{ 
                    darkMode: localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches),
                    toggle() {
                        this.darkMode = !this.darkMode;
                        localStorage.setItem('darkMode', this.darkMode);
                        if (this.darkMode) {
                            document.documentElement.classList.add('dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                        }
                    }
                }" x-init="
                    if (darkMode) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                ">
                    <button @click="toggle()" 
                        class="p-2.5 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 border border-gray-200 dark:border-gray-600"
                        aria-label="Toggle Dark Mode">
                        <i :class="darkMode ? 'fas fa-sun' : 'fas fa-moon'" class="text-lg"></i>
                    </button>
                </div>

                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                            class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 border border-gray-200 dark:border-gray-600"
                            aria-haspopup="true" 
                            :aria-expanded="open.toString()">
                            
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            
                            <div class="hidden sm:block text-left">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <i class="fas fa-chevron-down text-xs text-gray-500 dark:text-gray-400 transition-transform duration-200" 
                               :class="{ 'rotate-180': open }"></i>
                        </button>

                        <div x-show="open" 
                             @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 py-2 z-50">
                            
                            <div class="py-2">
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

                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" 
                                        class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                        <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-cog text-purple-600 dark:text-purple-400 text-xs"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium">Admin Panel</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Kelola sistem</p>
                                        </div>
                                    </a>
                                @elseif(Auth::user()->role === 'editor')
                                    <a href="{{ route('editor.dashboard') }}" 
                                        class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-pen text-green-600 dark:text-green-400 text-xs"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium">Editor Panel</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Kelola artikel</p>
                                        </div>
                                    </a>
                                @endif

                                <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>

                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" 
                                        class="w-full flex items-center px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-200">
                                        <div class="w-8 h-8 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center mr-3">
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
                @else
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" 
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors duration-200">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" 
                            class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transform hover:scale-105 transition-all duration-200 shadow-lg">
                            <i class="fas fa-user-plus mr-2"></i>
                            Daftar
                        </a>
                    </div>
                @endauth

                <button class="md:hidden p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200"
                        aria-label="Toggle mobile menu">
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </div>
    </div>
</nav>