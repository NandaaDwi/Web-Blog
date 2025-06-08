<footer class="bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 shadow-inner mt-12 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">

            <div>
                <a href="{{ route('home') }}" class="flex items-center space-x-3 mb-4 group">
                    <div
                        class="p-3 bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg group-hover:from-blue-700 group-hover:to-blue-800 transition-all duration-200">
                        <i class="fas fa-blog text-white text-2xl"></i>
                    </div>
                    <span
                        class="text-2xl font-extrabold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        BlogApp
                    </span>
                </a>
                <p class="text-sm max-w-xs leading-relaxed">
                    Tempat terbaik untuk membaca artikel berkualitas dan update terbaru setiap hari.
                </p>
            </div>

            <div>
                <h4 class="font-semibold mb-4 text-gray-900 dark:text-white">Quick Links</h4>
                <ul class="space-y-3 text-sm">
                    <li
                        class="flex items-center space-x-2 hover:text-blue-600 dark:hover:text-blue-400 transition cursor-pointer">
                        <i class="fas fa-chevron-right text-blue-600 dark:text-blue-400 text-xs"></i>
                        <a href="/" class="block">Beranda</a>
                    </li>
                    <li
                        class="flex items-center space-x-2 hover:text-blue-600 dark:hover:text-blue-400 transition cursor-pointer">
                        <i class="fas fa-chevron-right text-blue-600 dark:text-blue-400 text-xs"></i>
                        <a href="/about" class="block">Tentang Kami</a>
                    </li>
                    <li
                        class="flex items-center space-x-2 hover:text-blue-600 dark:hover:text-blue-400 transition cursor-pointer">
                        <i class="fas fa-chevron-right text-blue-600 dark:text-blue-400 text-xs"></i>
                        <a href="/contact" class="block">Kontak</a>
                    </li>
                    <li
                        class="flex items-center space-x-2 hover:text-blue-600 dark:hover:text-blue-400 transition cursor-pointer">
                        <i class="fas fa-chevron-right text-blue-600 dark:text-blue-400 text-xs"></i>
                        <a href="/privacy-policy" class="block">Kebijakan Privasi</a>
                    </li>
                    <li
                        class="flex items-center space-x-2 hover:text-blue-600 dark:hover:text-blue-400 transition cursor-pointer">
                        <i class="fas fa-chevron-right text-blue-600 dark:text-blue-400 text-xs"></i>
                        <a href="/terms" class="block">Syarat & Ketentuan</a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold mb-4 text-gray-900 dark:text-white">Ikuti Kami di Media Sosial</h4>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="https://facebook.com" target="_blank" rel="noopener"
                            class="flex items-center space-x-3 hover:text-blue-600 dark:hover:text-blue-400 transition font-medium">
                            <i class="fab fa-facebook-f text-blue-700 dark:text-blue-400 text-lg"></i>
                            <span>Facebook</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com" target="_blank" rel="noopener"
                            class="flex items-center space-x-3 hover:text-blue-600 dark:hover:text-blue-400 transition font-medium">
                            <i class="fab fa-twitter text-blue-400 dark:text-blue-300 text-lg"></i>
                            <span>Twitter</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://instagram.com" target="_blank" rel="noopener"
                            class="flex items-center space-x-3 hover:text-blue-600 dark:hover:text-blue-400 transition font-medium">
                            <i class="fab fa-instagram text-pink-500 dark:text-pink-400 text-lg"></i>
                            <span>Instagram</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://linkedin.com" target="_blank" rel="noopener"
                            class="flex items-center space-x-3 hover:text-blue-600 dark:hover:text-blue-400 transition font-medium">
                            <i class="fab fa-linkedin-in text-blue-700 dark:text-blue-400 text-lg"></i>
                            <span>LinkedIn</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com" target="_blank" rel="noopener"
                            class="flex items-center space-x-3 hover:text-blue-600 dark:hover:text-blue-400 transition font-medium">
                            <i class="fab fa-github text-blue-700 dark:text-blue-400 text-lg"></i>
                            <span>Github</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold mb-4 text-gray-900 dark:text-white">Kata Mereka</h4>
                <blockquote
                    class="italic text-sm text-gray-700 dark:text-gray-300 leading-relaxed border-l-4 border-blue-600 dark:border-blue-400 pl-4">
                    “BlogApp membantu saya mendapatkan inspirasi dan wawasan baru setiap hari. Sangat
                    direkomendasikan untuk penulis dan pembaca!”
                </blockquote>
                <p class="mt-4 font-semibold text-blue-600 dark:text-blue-400">— Nanda, Blogger</p>
            </div>
        </div>

        <div
            class="border-t border-gray-300 dark:border-gray-700 pt-6 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500 dark:text-gray-400 space-y-3 md:space-y-0">
            <div>
                &copy; {{ date('Y') }} BlogApp - Semua hak dilindungi.
            </div>
            <div>
                Dibuat dengan <i class="fas fa-heart text-red-500"></i> oleh <a href="https://yourwebsite.com"
                    target="_blank" class="hover:text-blue-600 dark:hover:text-blue-400">Nanda</a>
            </div>
        </div>
    </div>
</footer>
