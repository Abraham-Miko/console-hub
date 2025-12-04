<!-- Final Combined Checkout Page (Laravel Blade + Tailwind + Flowbite) -->
<x-page-template>

    {{-- <div class="container flex px-6 pt-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium  hover:text-[#ffa602] text-black">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                    </svg>
                    Beranda
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="#" class="ms-1 text-sm font-medium  hover:text-[#ffa602] md:ms-2 text-black">Katalog</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="#" class="ms-1 text-sm font-medium  hover:text-[#ffa602] md:ms-2 text-black">Keranjang</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ms-1 text-sm font-medium md:ms-2 text-gray-400">Checkout</span>
                </div>
            </li>
        </ol>
    </div> --}}

    <div class="container mx-auto px-6 py-10 grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT SIDE FORM -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Billing Address -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-2xl font-bold mb-4 uppercase">Checkout</h2>
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
                <h2 class="text-2xl font-bold mb-4 uppercase">Alamat Pengiriman</h2>
                <div class="space-y-3">
                    <label class="flex items-start gap-2">
                        <input type="radio" name="delivery" id="delivery-same" checked onclick="togglePickupAddress()">
                        Kirim di alamat diatas
                    </label>

                    <label class="flex items-start gap-2">
                        <input type="radio" name="delivery" id="delivery-pickup" onclick="togglePickupAddress()">
                        Ambil sendiri
                    </label>

                    <div id="pickup-address-detail" class="hidden pl-6 pt-1 text-gray-600 border-l border-gray-300 ml-2">
                        <p class="font-medium">Jl. Cakrawala No.5, Sumbersari, Kec. Lowokwaru, Kota Malang, Jawa Timur 65145</p>
                    </div>
                </div>
            </div>

            {{-- Payment Details --}}
            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-2xl font-bold mb-4 uppercase">Pilihan Pembayaran</h2>
                <div class="space-y-4">

                    <label class="flex items-center gap-2">
                        <input type="radio" name="payment" id="payment-bank" checked onclick="togglePaymentDetails()">
                        Transfer Bank (Jatim, BRI, BCA, Mandiri)
                    </label>

                    <div id="payment-bank-details" class="pl-6 pt-2 space-y-3">

                        <div class="p-3 shadow-md border rounded-lg flex flex-1 items-center space-x-2">
                            <img src="{{ asset('images/LOGO BANK JATIM.png') }}" alt="" class="w-24">
                            <div>
                                <p class="text-lg font-semibold">Bank Jatim</p>
                                <p class="text-sm text-gray-600">No. Rek: 1122-3344-5566-7788 (a/n Carental)</p>
                            </div>
                        </div>

                        <div class="p-3 shadow-md border rounded-lg flex flex-1 items-center space-x-2">
                            <img src="{{ asset('images/LOGO BANK BRI.png') }}" alt="" class="w-24">
                            <div>
                                <p class="text-lg font-semibold">Bank BRI</p>
                                <p class="text-sm text-gray-600">No. Rek: 1122-3344-5566-7788 (a/n Carental)</p>
                            </div>
                        </div>

                        <div class="p-3 shadow-md border rounded-lg flex flex-1 items-center space-x-2">
                            <img src="{{ asset('images/LOGO BANK BCA.png') }}" alt="" class="w-24">
                            <div>
                                <p class="text-lg font-semibold">Bank BCA</p>
                                <p class="text-sm text-gray-600">No. Rek: 1122-3344-5566-7788 (a/n Carental)</p>
                            </div>
                        </div>

                        <div class="p-3 shadow-md border rounded-lg flex flex-1 items-center space-x-2">
                            <img src="{{ asset('images/LOGO BANK MANDIRI.png') }}" alt="" class="w-24">
                            <div>
                                <p class="text-lg font-semibold">Bank Mandiri</p>
                                <p class="text-sm text-gray-600">No. Rek: 1122-3344-5566-7788 (a/n Carental)</p>
                            </div>
                        </div>
                    </div>

                    <label class="flex items-center gap-2">
                        <input type="radio" name="payment" id="payment-qris-radio" onclick="togglePaymentDetails()">
                        Pembayaran melalui QRIS
                    </label>

                    <div id="payment-qris-details" class="hidden pl-6 pt-2">
                        <div class="w-48 h-48 border p-2 bg-white shadow-md rounded-lg">
                            <img src="#" alt="">
                        </div>
                    </div>

                </div>
            </div>

            {{-- Upload Bukti Pembayaran --}}
            <div id="payment-proof-section" class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-2xl font-bold mb-4 uppercase">Upload Bukti Pembayaran</h2>
                <div class="space-y-4">
                    <p class="text-sm text-gray-600">Silakan unggah bukti transfer atau QRIS.</p>
                    <div>
                        <label class="font-medium block mb-1">Upload Bukti Pembayaran</label>
                        <input type="file" id="bukti-pembyaran" accept="image/*" class="w-full border rounded-lg p-2 mt-1">
                    </div>
                </div>
            </div>

            {{-- Upload Jaminan Peminjaman--}}
            <div id="payment-proof-section" class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-2xl font-bold mb-4 uppercase">Upload Jaminan Peminjaman</h2>
                <div class="space-y-4">
                    <p class="text-sm text-gray-600">Silakan unggah foto jaminan peminjaman.</p>
                    <div>
                        <label class="font-medium block mb-1">Upload Jaminan Peminjaman</label>
                        <input type="file" id="bukti-pembyaran" accept="image/*" class="w-full border rounded-lg p-2 mt-1">
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT SIDE ORDER SUMMARY -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-xl shadow space-y-4">
                <h2 class="text-2xl font-bold mb-2 uppercase">Order summary</h2>

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
                    Checkout
                </button>
            </div>
        </div>
    </div>

    <script>
        function togglePickupAddress() {
            const pickupRadio = document.getElementById('delivery-pickup');
            const pickupAddressDetail = document.getElementById('pickup-address-detail');

            // Cek apakah radio button "Ambil sendiri" terpilih
            if (pickupRadio.checked) {
                // Jika terpilih, tampilkan alamat (hapus kelas hidden)
                pickupAddressDetail.classList.remove('hidden');
            } else {
                // Jika tidak terpilih ("Kirim di alamat diatas" yang terpilih), sembunyikan alamat (tambahkan kelas hidden)
                pickupAddressDetail.classList.add('hidden');
            }
        }

        // Panggil saat halaman dimuat untuk memastikan status awal sesuai dengan radio button yang checked
        document.addEventListener('DOMContentLoaded', togglePickupAddress);

        function togglePaymentDetails() {
            const bankRadio = document.getElementById('payment-bank');
            const bankDetails = document.getElementById('payment-bank-details');
            const qrisDetails = document.getElementById('payment-qris-details');

            if (bankRadio.checked) {
                // Tampilkan detail bank
                bankDetails.classList.remove('hidden');
                qrisDetails.classList.add('hidden');
            } else {
                // Tampilkan detail QRIS
                bankDetails.classList.add('hidden');
                qrisDetails.classList.remove('hidden');
            }
        }

        // Panggil saat halaman dimuat untuk memastikan status awal
        document.addEventListener('DOMContentLoaded', togglePaymentDetails);
    </script>

</x-page-template>
