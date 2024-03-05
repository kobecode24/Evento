<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ mix('resources/css/app.css') }}" />

</head>

<body class="antialiased">
<!-- component -->
<script
    src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
    defer
></script>

<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
    <div
        :class="sidebarOpen ? 'block' : 'hidden'"
        @click="sidebarOpen = false"
        class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"
    ></div>

    <!-- Sidebar -->
    @include('layouts.admin.sidebar')


    <div class="flex flex-col flex-1 overflow-hidden">

        <!-- header -->
        @include('layouts.admin.header')

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            @yield('contents')
        </main>

    </div>
</div>
</body>
</html>
