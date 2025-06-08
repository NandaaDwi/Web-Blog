@props(['paginator'])

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-4">
        <ul class="inline-flex items-center -space-x-px text-gray-600 dark:text-gray-300">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="px-3 py-1 cursor-not-allowed opacity-50"><i class="fas fa-chevron-left"></i></li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="px-3 py-1 hover:text-gray-900 dark:hover:text-white">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($paginator->elements() as $element)
                @if (is_string($element))
                    <li class="px-3 py-1 cursor-default">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="px-3 py-1 bg-blue-600 text-white rounded">{{ $page }}</li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="px-3 py-1 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="px-3 py-1 hover:text-gray-900 dark:hover:text-white">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="px-3 py-1 cursor-not-allowed opacity-50"><i class="fas fa-chevron-right"></i></li>
            @endif
        </ul>
    </nav>
@endif
