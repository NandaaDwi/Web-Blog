@props(['items' => []])

<nav class="text-sm mb-4" aria-label="Breadcrumb">
    <ol class="list-reset flex text-gray-600 dark:text-gray-400">
        @foreach ($items as $index => $item)
            <li class="flex items-center">
                @if (!empty($item['url']) && $index < count($items) - 1)
                    <a href="{{ $item['url'] }}" class="hover:underline hover:text-gray-800 dark:hover:text-gray-200">
                        {{ $item['label'] }}
                    </a>
                    <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M9.29 6.71a1 1 0 0 1 1.42 0l5.3 5.3a1 1 0 0 1 0 1.42l-5.3 5.3a1 1 0 1 1-1.42-1.42L13.17 12 9.3 8.12a1 1 0 0 1 0-1.41z" />
                    </svg>
                @else
                    <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $item['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
