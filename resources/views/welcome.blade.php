<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="icon" type="image/png" href="{{ asset('images/LOGO.png') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
        @endif
    </head>

<body class="bg-white font-outfit">

    {{-- NAVBAR --}}
    <nav class="w-full py-4 bg-transparent">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div href="/" class="">
                <x-main-logo/>
            </div>

            <div>
                @auth

                    <a
                        href="{{ url('/dashboard') }}"
                        class="inline-block font-bold tracking-wide px-5 py-2.5 bg-[#ffa602] border-[#19140035] hover:border-[#1915014a] border text-[#000000] hover:text-[#ffffff] rounded-xl text-sm leading-none transition"
                    >
                        Dashboard
                    </a>

                    <a
                        href="{{ url('/katalog') }}"
                        class="inline-block font-bold tracking-wide px-5 py-2.5 bg-[#ffa602] border-[#19140035] hover:border-[#1915014a] border text-[#000000] hover:text-[#ffffff] rounded-xl text-sm leading-none transition"
                    >
                        Katalog
                    </a>

                @else

                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 text-md">Log in &raquo;</a>

                @endauth
            </div>

        </div>
    </nav>

    {{-- MAIN SECTION --}}
    <div class="container mx-auto px-6 items-center text-center py-32">
        <img src="{{ asset('images/MAIN PICTURE.jpg') }}" alt="Main Picture"
            class="mx-auto w-40 md:w-56 object-contain mb-6">

        <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight text-gray-900">
            Console Hub
        </h1>

        <hr class="my-6 border-gray-500 w-48 mx-auto">

        <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-600">
            Tempat rental segala alat konsol gaming kesayanganmu. <br>
            Nikmati pengalaman bermain yang tak terlupakan dengan koleksi lengkap kami.
        </p>

        <div class="mt-10 flex justify-center space-x-4">
            <a href="{{ url('/katalog') }}"
               class="px-6 py-3 bg-[#ffa602] text-black rounded-lg font-medium hover:text-[#ffffff] transition">
                Sewa Sekarang  &raquo;
            </a>
        </div>
    </div>
    
    {{-- WHY CHOOSE US SECTION --}}
    <div class="mt-24 bg-gray-50 py-16">
        <div class="container mx-auto px-6 py-24 text-center">
            <h2 class="mt-2 text-4xl md:text-5xl font-extrabold text-gray-900">
                Mengapa harus memilih kami?
            </h2>
        </div>

        <div class="container mx-auto px-6 mt-16">
            <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 justify-center">

                {{-- 1. Kartu: Harga terjangkau --}}
                <x-why-must-choose-us-section
                    title="Harga terjangkau"
                    description="Segala alat gaming yang kami sewakan memiliki harga yang bersahabat untuk semua kalangan, sehingga Anda dapat menikmati pengalaman bermain tanpa khawatir tentang biaya."
                    icon-path='<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.345a4.76 4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866
                                -1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.486-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538 1.592m-3.879 12.171V21m0-18v2.2"/>
                                </svg>'
                />

                {{-- 2. Kartu: Kemudahan penyewaan --}}
                <x-why-must-choose-us-section
                    title="Kemudahan penyewaan"
                    description="Kamu tidak perlu repot-repot datang ke tempat kami. Cukup lakukan penyewaan secara online melalui website kami dan alatnya akan diantar langsung ke lokasi kamu."
                    icon-path='<path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v
                    -6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>'
                />

                {{-- 3. Kartu: Kemudahan pembayaran --}}
                <x-why-must-choose-us-section
                    title="Kemudahan pembayaran"
                    description="Enggak punya cash? Tenang! Kami menerima berbagai metode pembayaran digital yang memudahkan kamu untuk menyelesaikan transaksi tanpa ribet."
                    icon-path='<path fill-rule="evenodd" d="M7 6a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2h-2v-4a3 3 0 0 0-3-3H7V6Z" clip-rule="evenodd"/><path fill-rule="evenodd" d="M2 11a2 2 0 0 1
                    2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-7Zm7.5 1a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5Z" clip-rule="evenodd"/><path d="M10.5 14.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"/>'
                />

                {{-- 4. Kartu: Banyak pilihan alat gaming --}}
                <x-why-must-choose-us-section
                    title="Banyak pilihan alat gaming"
                    description="Kami menyediakan berbagai jenis alat gaming mulai dari konsol, aksesori, hingga game terbaru yang siap untuk disewa sesuai dengan kebutuhan dan preferensi kamu."
                    icon-path='<path d="M20 7h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C10.4 2.842 8.949 2 7.5 2A3.5 3.5 0 0 0 4 5.5c.003.52.123 1.033.351 1.5H4a2
                    2 0 0 0-2 2v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V9a2 2 0 0 0-2-2Zm-9.942 0H7.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5
                    1.5 0 0 1 0 3h.003ZM13 14h-2v8h2v-8Zm-4 0H4v6a2 2 0 0 0 2 2h3v-8Zm6 0v8h3a2 2 0 0 0 2-2v-6h-5Z"/>'
                />

            </div>
        </div>

    </div>

    {{-- FAQ Section --}}
    <div class="container x-6 mt-48 max-w-3xl">
        <h2 class="text-4xl font-extrabold text-gray-900 mb-10">
            Pertanyaan yang sering diajukan (FAQ)
        </h2>

        <div class="space-y-6">

            {{-- Q1 --}}
            <div x-data="{ open: false }" class="border-b border-gray-300 pb-4">
                <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                    <span class="text-gray-900 text-lg font-medium">
                        Bagaimana jika saya terlambat mengembalikan alat yang saya sewa?
                    </span>
                    <span class="text-2xl text-gray-700 font-light">
                        <span x-show="!open">+</span>
                        <span x-show="open">−</span>
                    </span>
                </button>

                <p x-show="open" x-transition class="mt-3 ml-6 text-gray-600">
                    Kami akan memberikan denda keterlambatan sesuai dengan ketentuan yang berlaku
                    sehingga pastikan untuk mengembalikan alat tepat waktu.
                </p>
            </div>

            {{-- Q2 --}}
            <div x-data="{ open: false }" class="border-b border-gray-300 pb-4">
                <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                    <span class="text-gray-900 text-lg font-medium">
                        Berapa lama durasi penyewaannya?
                    </span>
                    <span class="text-2xl text-gray-700 font-light">
                        <span x-show="!open">+</span>
                        <span x-show="open">−</span>
                    </span>
                </button>

                <p x-show="open" x-transition class="mt-3 ml-6 text-gray-600">
                    Durasi sewa fleksibel mulai dari 6 jam dan harian.
                    Info selengkapnya bisa kamu cek di halaman penyewaan.
                </p>
            </div>

            {{-- Q3 --}}
            <div x-data="{ open: false }" class="border-b border-gray-300 pb-4">
                <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                    <span class="text-gray-900 text-lg font-medium">
                        Apakah perangkat pasti dalam kondisi siap pakai?
                    </span>
                    <span class="text-2xl text-gray-700 font-light">
                        <span x-show="!open">+</span>
                        <span x-show="open">−</span>
                    </span>
                </button>

                <p x-show="open" x-transition class="mt-3 ml-6 text-gray-600">
                    Ya. Semua perangkat melalui pengecekan kualitas (QC) sebelum disewa, termasuk kebersihan, performa, dan kelengkapan aksesoris.
                </p>
            </div>

            {{-- Q4 --}}
            <div x-data="{ open: false }" class="border-b border-gray-300 pb-4">
                <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                    <span class="text-gray-900 text-lg font-medium">
                        Apakah membutuhkan deposit?
                    </span>
                    <span class="text-2xl text-gray-700 font-light">
                        <span x-show="!open">+</span>
                        <span x-show="open">−</span>
                    </span>
                </button>

                <p x-show="open" x-transition class="mt-3 ml-6 text-gray-600">
                    Ya, sebagian perangkat memerlukan deposit sebagai jaminan kerusakan atau kehilangan. Nilainya berbeda tergantung jenis alat yang disewa.
                </p>
            </div>

            {{-- Q5 --}}
            <div x-data="{ open: false }" class="border-b border-gray-300 pb-4">
                <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                    <span class="text-gray-900 text-lg font-medium">
                        Apakah deposit akan dikembalikan?
                    </span>
                    <span class="text-2xl text-gray-700 font-light">
                        <span x-show="!open">+</span>
                        <span x-show="open">−</span>
                    </span>
                </button>

                <p x-show="open" x-transition class="mt-3 ml-6 text-gray-600">
                    Deposit dikembalikan 100% setelah perangkat kami terima kembali dalam kondisi baik dan lengkap.
                </p>
            </div>

            {{-- Q6 --}}
            <div x-data="{ open: false }" class="border-b border-gray-300 pb-4">
                <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                    <span class="text-gray-900 text-lg font-medium">
                        Apakah boleh mengambil sendiri ke tempat kami?
                    </span>
                    <span class="text-2xl text-gray-700 font-light">
                        <span x-show="!open">+</span>
                        <span x-show="open">−</span>
                    </span>
                </button>

                <p x-show="open" x-transition class="mt-3 ml-6 text-gray-600">
                    Tentu. Anda bisa datang langsung ke lokasi kami untuk mengambil atau mengembalikan perangkat tanpa biaya tambahan.
                </p>
            </div>

        </div>
    </div>

    {{-- FOOTER --}}
    <footer class="bg-[#e4e2e2] mt-72">
        <div class="border-t border-gray-300"></div>

        <div class="container mx-auto px-6 py-6 flex items-center justify-between">

            {{-- Copyright --}}
            <p class="text-gray-600 text-sm">
                © 2025 Console Hub Ofiicial Site.
            </p>

            {{-- Social Icons --}}
            <div class="flex space-x-10 text-gray-600">

                <a href="#" class="hover:text-gray-900">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1
                    0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                    </svg>
                </a>

                <a href="#" class="hover:text-gray-900">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13.795 10.533 20.68 2h-3.073l-5.255 6.517L7.69 2H1l7.806 10.91L1.47 22h3.074l5.705-7.07L15.31 22H22l-8.205-11.467Zm-2.38 2.95L9.97 11.464 4.36 3.627h2.31l4.528 6.317 1.443 2.02 6.018 8.409h-2.31l-4.934-6.89Z"/>
                    </svg>
                </a>

                <a href="#" class="hover:text-gray-900">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12.006 2a9.847 9.847 0 0 0-6.484 2.44 10.32 10.32 0 0 0-3.393 6.17 10.48 10.48 0 0 0 1.317 6.955 10.045 10.045 0 0 0 5.4 4.418c.504.095.683-.223.683-.494 0-.245-.01-1.052-.014-1.908-2.78.62-3.366
                    -1.21-3.366-1.21a2.711 2.711 0 0 0-1.11-1.5c-.907-.637.07-.621.07-.621.317.044.62.163.885.346.266.183.487.426.647.71.135.253.318.476.538.655a2.079 2.079 0 0 0 2.37.196c.045-.52.27-1.006.635-1.37-2.219-.259-4.554-1.138-4.554-5.07a4.022
                    4.022 0 0 1 1.031-2.75 3.77 3.77 0 0 1 .096-2.713s.839-.275 2.749 1.05a9.26 9.26 0 0 1 5.004 0c1.906-1.325 2.74-1.05 2.74-1.05.37.858.406 1.828.101 2.713a4.017 4.017 0 0 1 1.029 2.75c0 3.939-2.339 4.805-4.564 5.058a2.471 2.471 0 0 1 .679
                    1.897c0 1.372-.012 2.477-.012 2.814 0 .272.18.592.687.492a10.05 10.05 0 0 0 5.388-4.421 10.473 10.473 0 0 0 1.313-6.948 10.32 10.32 0 0 0-3.39-6.165A9.847 9.847 0 0 0 12.007 2Z" clip-rule="evenodd"/>
                    </svg>
                </a>

            </div>
        </div>
    </footer>


    @vite('resources/js/app.js')
    <script src="/node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>
