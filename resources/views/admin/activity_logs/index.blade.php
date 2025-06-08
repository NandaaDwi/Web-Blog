@extends('layouts.app')

@section('content')
<div x-data="{
    search: '',
    matches(log) {
        if (this.search === '') return true;
        const searchTerm = this.search.toLowerCase();
        return log.user.toLowerCase().includes(searchTerm) ||
               log.action.toLowerCase().includes(searchTerm) ||
               log.target.toLowerCase().includes(searchTerm) ||
               log.targetId.toString().includes(searchTerm);
    }
}" class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-2">
                <div class="p-2 bg-blue-600 rounded-lg">
                    <i class="fas fa-history text-white text-xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Log Aktivitas</h1>
            </div>
            <p class="text-gray-600 dark:text-gray-400">Pantau semua aktivitas sistem</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 rounded-lg shadow-sm">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-red-400 mr-3 mt-1"></i>
                    <div>
                        <p class="text-red-800 font-medium mb-2">Terjadi kesalahan:</p>
                        <ul class="list-disc list-inside space-y-1 text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <div class="relative w-full sm:w-80">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" x-model="search" placeholder="Cari user, aksi, target, atau ID..."
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 transition-all duration-200"
                    aria-label="Cari log aktivitas" />
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-clock"></i>
                                    <span>Waktu</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-user"></i>
                                    <span>User</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                <div class="flex items-center justify-center space-x-2">
                                    <i class="fas fa-bolt"></i>
                                    <span>Aksi</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-target"></i>
                                    <span>Target</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($logs as $log)
                            <tr x-show="matches({
                                user: '{{ addslashes($log->user->name ?? 'System') }}',
                                action: '{{ addslashes($log->action) }}',
                                target: '{{ addslashes(class_basename($log->loggable_type)) }}',
                                targetId: {{ $log->loggable_id }}
                            })" class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 dark:text-white font-medium">
                                        {{ $log->created_at->format('d M Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $log->created_at->format('H:i:s') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0">
                                            <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-blue-600 dark:text-blue-400 text-xs"></i>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $log->user->name ?? 'System' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if(str_contains(strtolower($log->action), 'create')) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                        @elseif(str_contains(strtolower($log->action), 'update')) bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                        @elseif(str_contains(strtolower($log->action), 'delete')) bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                                        @else bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300 @endif">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 dark:text-white font-medium">
                                        {{ class_basename($log->loggable_type) }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        ID: {{ $log->loggable_id }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center space-y-3">
                                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                            <i class="fas fa-history text-gray-400 text-2xl"></i>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400 font-medium">Tidak ada log aktivitas</p>
                                        <p class="text-sm text-gray-400 dark:text-gray-500">Log akan muncul saat ada aktivitas sistem</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($logs->hasPages())
            <div class="mt-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection