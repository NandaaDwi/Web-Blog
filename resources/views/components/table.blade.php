<table
    {{ $attributes->merge(['class' => 'min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-700 shadow-sm rounded-md overflow-hidden']) }}>
    <thead
        class="bg-gray-50 dark:bg-gray-700 text-left text-gray-700 dark:text-gray-200 text-sm uppercase tracking-wider">
        {{ $thead ?? '' }}
    </thead>
    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
        {{ $tbody ?? '' }}
    </tbody>
</table>
