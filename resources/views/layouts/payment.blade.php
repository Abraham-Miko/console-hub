<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="icon" type="image/png" href="{{ asset('images/LOGO.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
    @endif
</head>
<body class="bg-gray-50 min-h-screen py-10 font-outfit">

    <!-- PROGRESS STEP -->
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between text-sm font-medium text-gray-500">

            <div class="flex flex-col items-center">
                <div class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-600 text-white shadow">
                    1
                </div>
                <span class="mt-2">Metode</span>
            </div>

            <div class="flex flex-col items-center">
                <div class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-600 text-white shadow">
                    2
                </div>
                <span class="mt-2">Pembayaran</span>
            </div>

            <div class="flex flex-col items-center">
                <div class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-300 text-gray-700">
                    3
                </div>
                <span class="mt-2">Selesai</span>
            </div>

        </div>
    </div>

    <!-- MAIN CARD -->
    <div class="max-w-3xl mx-auto mt-10 bg-white p-10 rounded-2xl shadow-xl space-y-10">

        <h2 class="text-2xl font-bold text-gray-800">Pembayaran Via Transfer Bank</h2>

        <!-- BANK OPTIONS -->
        <div>
            <p class="font-semibold mb-3 text-gray-700">Pilih Bank:</p>

            <div class="grid md:grid-cols-2 gap-6">

                <!-- BANK BCA -->
                <label class="border rounded-xl p-5 flex items-center gap-4 cursor-pointer hover:border-blue-500 transition">
                    <input type="radio" name="bank" class="accent-blue-600" checked>
                    <img src="https://seeklogo.com/images/B/bca-bank-central-asia-logo-0E85F39CC3-seeklogo.com.png" class="w-14">
                    <div>
                        <p class="font-semibold text-gray-800">Bank BCA</p>
                        <p class="text-sm text-gray-500">Transfer Online / ATM</p>
                    </div>
                </label>

                <!-- BANK MANDIRI -->
                <label class="border rounded-xl p-5 flex items-center gap-4 cursor-pointer hover:border-blue-500 transition">
                    <input type="radio" name="bank" class="accent-blue-600">
                    <img src="https://seeklogo.com/images/B/bank-mandiri-logo-DA2E27F0F0-seeklogo.com.png" class="w-14">
                    <div>
                        <p class="font-semibold text-gray-800">Bank Mandiri</p>
                        <p class="text-sm text-gray-500">Transfer Online / ATM</p>
                    </div>
                </label>

                <!-- BANK BRI -->
                <label class="border rounded-xl p-5 flex items-center gap-4 cursor-pointer hover:border-blue-500 transition">
                    <input type="radio" name="bank" class="accent-blue-600">
                    <img src="https://seeklogo.com/images/B/bri-bank-rakyat-indonesia-logo-0B09A708B1-seeklogo.com.png" class="w-14">
                    <div>
                        <p class="font-semibold text-gray-800">Bank BRI</p>
                        <p class="text-sm text-gray-500">Transfer Online / ATM</p>
                    </div>
                </label>

                <!-- BANK JATIM -->
                <label class="border rounded-xl p-5 flex items-center gap-4 cursor-pointer hover:border-blue-500 transition">
                    <input type="radio" name="bank" class="accent-blue-600">
                    <img src="https://seeklogo.com/images/B/bank-jatim-logo-4F05DF18A6-seeklogo.com.png" class="w-14">
                    <div>
                        <p class="font-semibold text-gray-800">Bank Jatim</p>
                        <p class="text-sm text-gray-500">Transfer Online / ATM</p>
                    </div>
                </label>

            </div>
        </div>

        <!-- TOTAL PAYMENT -->
        <div>
            <p class="font-semibold text-gray-700 mb-2">Total Pembayaran</p>
            <div class="bg-gray-100 p-4 rounded-xl flex justify-between items-center">
                <span class="font-bold text-xl text-blue-600">Rp 7.191.000</span>
                <span class="text-sm underline text-blue-600 cursor-pointer">Lihat rincian</span>
            </div>
        </div>

        <!-- ACCOUNT INFO -->
        <div class="space-y-2">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Rekening</h3>
            <p class="text-gray-700">Nama Pemilik Rekening: <span class="font-semibold">PT Example Store</span></p>
            <p class="text-gray-700">No. Rekening: <span class="font-semibold">1234567890</span></p>
            <p class="text-gray-700">Bank: <span class="font-semibold">Sesuai pilihan Anda</span></p>
        </div>

        <!-- UPLOAD -->
        <div>
            <p class="font-semibold text-gray-700">Upload Bukti Transfer</p>
            <input type="file" class="mt-2 w-full border rounded-xl p-3">
        </div>

        <!-- ALERT -->
        <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl text-sm text-blue-800">
            Pastikan bukti transfer jelas dan terbaca sebelum mengonfirmasi pembayaran.
        </div>

        <!-- BUTTONS -->
        <div class="flex justify-end gap-3 mt-6">
            <button class="px-6 py-3 rounded-xl border text-gray-700 hover:bg-gray-100">
                Kembali
            </button>

            <button class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-md">
                Konfirmasi Pembayaran
            </button>
        </div>

    </div>

</body>
</html>
