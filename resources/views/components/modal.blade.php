<div x-data="{ show: false }" x-show="show" @keydown.escape.window="show = false" style="display: none;"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div @click.away="show = false" class="bg-white dark:bg-gray-800 rounded shadow-lg max-w-lg w-full p-6" role="dialog"
        aria-modal="true" aria-labelledby="modal-title">
        <header class="flex justify-between items-center mb-4">
            <h2 id="modal-title" class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                {{ $title ?? 'Modal Title' }}
            </h2>
            <button @click="show = false"
                class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </header>
        <div>
            {{ $slot }}
        </div>
    </div>
</div>
