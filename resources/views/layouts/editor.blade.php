<!DOCTYPE html>
<html lang="en" class="dark scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editor Layout</title>

    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">

    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

        <div :class="{ '-translate-x-full': !sidebarOpen }"
            class="md:translate-x-0 fixed inset-y-0 left-0 z-40 w-64 transition-transform transform bg-white dark:bg-gray-900 md:static md:inset-0"
            x-cloak>
            <x-editor.sidebar />
        </div>

        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-30 bg-black opacity-50 md:hidden"
            x-cloak></div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <x-navbar />
            <main class="flex-1 p-6 overflow-y-auto mt-24 sm:mt-0">
                @yield('content')
            </main>
        </div>

    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
            } else {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
            }
        }

        document.documentElement.classList.toggle(
            "dark",
            localStorage.theme === "dark" ||
            (!("theme" in localStorage) && window.matchMedia("(prefers-color-scheme: dark)").matches),
        );
        localStorage.theme = "light";
        localStorage.theme = "dark";
        localStorage.removeItem("theme");
    </script>

</body>

</html>
