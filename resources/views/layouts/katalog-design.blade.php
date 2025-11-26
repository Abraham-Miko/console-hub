<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    {{-- NAVBAR BUATANMU SENDIRI --}}
    <nav class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between">
            <h1 class="font-bold text-xl">My Custom Layout</h1>

            <div class="flex gap-4">
                <a href="/" class="hover:underline">Home</a>
                <a href="/search" class="hover:underline">Search</a>
            </div>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    <main class="container mx-auto mt-6">
        @yield('content')
    </main>

</body>
</html>
