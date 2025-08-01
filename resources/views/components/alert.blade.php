@props(['type' => 'info'])

@php
    $colors = [
        'info' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
        'success' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
        'warning' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
        'error' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
    ];
    $colorClass = $colors[$type] ?? $colors['info'];
@endphp

<div {{ $attributes->merge(['class' => "p-4 rounded mb-4 {$colorClass}"]) }}>
    {{ $slot }}
</div>
