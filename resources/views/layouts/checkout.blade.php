<!-- Final Combined Checkout Page (Laravel Blade + Tailwind + Flowbite) -->
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

<body class="bg-gray-50 font-outfit">

    <div class="container mx-auto px-6 py-10 grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT SIDE FORM -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Billing Address -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-xl font-semibold mb-4">Checkout</h2>
                <form class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="font-medium">Nama Lengkap*</label>
                        <input class="w-full border rounded-lg p-2 mt-1">
                    </div>

                    <div>
                        <label class="font-medium">NIK*</label>
                        <input class="w-full border rounded-lg p-2 mt-1">
                    </div>

                    <div class="md:col-span-2">
                        <label class="font-medium">Alamat Lengkap*</label>
                        <input class="w-full border rounded-lg p-2 mt-1">
                    </div>

                    <div>
                        <label class="font-medium">No. Telepon*</label>
                        <input class="w-full border rounded-lg p-2 mt-1">
                    </div>

                    <div>
                        <label class="font-medium">Jaminan Penyewa*</label>
                        <select class="w-full border rounded-lg p-2 mt-1">
                            <option value="" disabled selected hidden>- Pilih Jaminan -</option>
                            <option>KTP</option>
                            <option>KTM</option>
                            <option>SIM</option>
                            <option>STNK</option>
                            <option>Passport</option>
                        </select>
                    </div>

                    <div>
                        <label class="font-medium">Tanggal Mulai*</label>
                        <input class="w-full border rounded-lg p-2 mt-1" type="date">
                    </div>

                    <div>
                        <label class="font-medium">Durasi Rental*</label>
                        <select class="w-full border rounded-lg p-2 mt-1">
                            <option value="" disabled selected hidden>- Pilih Durasi -</option>
                            <option>1 hari</option>
                            <option>2 hari</option>
                            <option>3 hari</option>
                            <option>4 hari</option>
                            <option>5 hari</option>
                            <option>6 hari</option>
                            <option>7 hari</option>
                        </select>
                    </div>

                </form>
            </div>

            <!-- Delivery Address -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-xl font-semibold mb-4">Alamat Pengiriman</h2>
                <div class="space-y-3">
                    <label class="flex items-center gap-2"><input type="radio" name="delivery" checked> Kirim di alamat diatas</label>
                    <label class="flex items-center gap-2"><input type="radio" name="delivery"> Ambil sendiri</label>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-xl font-semibold mb-4">Pilihan Pembayaran</h2>
                <div class="space-y-3">
                    <label class="flex items-center gap-2"><input type="radio" name="payment" checked> Transfer Bank (Jatim, BRI, BCA, Mandiri)</label>
                    <label class="flex items-center gap-2"><input type="radio" name="payment"> Pembayaran melalui QRIS</label>
                </div>
            </div>

        </div>

        <!-- RIGHT SIDE ORDER SUMMARY -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-xl shadow space-y-4">
                <h2 class="text-xl font-semibold mb-2">Order summary</h2>

                <div class="flex gap-4 border-b pb-4">
                    <div class="w-16 h-16 bg-gray-200 rounded">
                        <img src="{{ asset('images/PS5.jpg') }}" alt="">
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold">PlayStation 5</p>
                        <p class="text-sm text-gray-600">Durasi sewa : 1 hari</p>
                    </div>
                    <span class="font-semibold">Rp 60.000,00</span>
                </div>

                <div class="text-sm space-y-1 pt-4">
                    <div class="flex justify-between"><span>Jumlah</span><span>Rp 60.000,00</span></div>
                    <div class="flex justify-between"><span>Biaya pengiriman</span><span>Rp 10.000,00</span></div>
                    <div class="flex justify-between"><span>Diskon</span><span>-</span></div>
                </div>

                <div class="flex justify-between font-bold text-lg border-t pt-4">
                    <span>Total</span>
                    <span>Rp 70.000,00</span>
                </div>

                <button class="w-full bg-[#ffa602] text-black hover:text-white py-3 rounded-lg text-center font-semibold">
                    Continue to payment
                </button>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
</body>
</html>
