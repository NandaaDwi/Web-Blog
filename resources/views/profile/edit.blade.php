<!DOCTYPE html>
<html lang="en" class="scroll-smooth" x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }" :class="{ 'dark': darkMode }" x-init="$watch('darkMode', val => localStorage.setItem('theme', val))">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Blog System') }}</title>

    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <x-navbar/>
    
    <div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 rounded shadow mt-16" x-data="{ edit: false }">
        @if (session('success'))
            <div class="mb-4 rounded-md bg-green-700 p-2 border border-green-700 text-white">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded-md bg-red-700 p-4 border border-red-700 text-white">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex items-center space-x-6">
            <form method="POST" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data" id="photoForm">
                @csrf
                @method('PUT')

                <label for="profile_photo"
                    class="relative w-24 h-24 rounded-full overflow-hidden border-2 border-gray-300 dark:border-gray-600 cursor-pointer group block">
                    <img src="{{ $user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                        alt="Foto Profil"
                        class="w-full h-full object-cover rounded-full group-hover:opacity-70 transition duration-300">

                    <div
                        class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <i class="fas fa-camera text-white"></i>
                    </div>

                    <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="hidden"
                        onchange="document.getElementById('photoForm').submit()">
                </label>
            </form>

            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $user->name }}</h1>
                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $user->email }}</p>
            </div>

            <div class="ml-auto">
                <button @click="edit = !edit"
                    class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-blue-600 transition">
                    <i class="fas fa-edit mr-1"></i> Edit Profil
                </button>
            </div>
        </div>

        <div x-show="edit" x-transition class="mt-6" style="display: none;">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-input label="Nama" id="name" name="name" type="text" :value="old('name', $user->name)" required />
                    <x-input label="Email" id="email" name="email" type="email" :value="old('email', $user->email)" required />
                </div>

                <div class="mt-4">
                    <x-input label="Password Baru" id="password" name="password" type="password"
                        placeholder="Kosongkan jika tidak diubah" autocomplete="new-password" />
                    <x-input label="Konfirmasi Password" id="password_confirmation" name="password_confirmation"
                        type="password" placeholder="Kosongkan jika tidak diubah" autocomplete="new-password" />
                </div>

                <x-button class="mt-4 w-full">Simpan Perubahan</x-button>
            </form>
        </div>
    </div>
</body>

</html>
