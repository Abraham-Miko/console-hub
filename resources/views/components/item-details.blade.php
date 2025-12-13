<x-page-template>

    <div id="detail-peralatan-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-70 flex justify-center items-center p-4">

        <div class="relative w-full max-w-2xl bg-white rounded-xl shadow-2xl transform transition-all duration-300">

            <div class="relative">

                <button type="button" data-modal-hide="detail-peralatan-modal"
                        class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>

                <div class="grid grid-cols-1 md:grid-cols-2">

                    <div class="h-64 md:h-full bg-gray-100 rounded-t-xl md:rounded-l-xl md:rounded-tr-none overflow-hidden">
                        <img id="detail-image"
                            src="{{-- Gunakan URL gambar peralatan --}}"
                            alt="Foto Peralatan"
                            class="w-full h-full object-cover">
                    </div>

                    <div class="p-6 space-y-4">

                        <h3 id="detail-merek" class="text-3xl font-extrabold text-gray-900 leading-tight">
                            {{-- Nama Merek Peralatan --}}
                        </h3>

                        <p id="detail-deskripsi" class="text-sm text-gray-600 border-b pb-4">
                            {{-- Deskripsi atau Spesifikasi Singkat --}}
                        </p>

                        <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm">
                            <span class="font-medium text-gray-700">Tersedia:</span>
                            <span id="detail-tersedia" class="font-bold text-green-600">
                                {{-- Jumlah Unit Tersedia --}}
                            </span>

                            <span class="font-medium text-gray-700">Tipe:</span>
                            <span id="detail-tipe" class="font-bold text-gray-900">
                                {{-- Tipe atau Model --}}
                            </span>
                        </div>

                        <div class="pt-4 border-t">
                            <p class="text-lg text-gray-700 font-medium">Harga Rental:</p>
                            <p id="detail-harga" class="text-4xl font-extrabold text-indigo-600">
                                Rp {{-- 0.000 --}} <span class="text-base font-normal text-gray-500">/ hari</span>
                            </p>
                        </div>

                        <div class="pt-4">
                            <a href="{{-- Link ke halaman Checkout --}}" class="block w-full text-center bg-indigo-600 text-white font-semibold py-3 rounded-lg hover:bg-indigo-700 transition duration-150">
                                Sewa Sekarang
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Dapatkan elemen modal dan tombolnya
        const modal = document.getElementById('detail-peralatan-modal');
        const modalImage = document.getElementById('detail-image');
        const modalMerek = document.getElementById('detail-merek');
        // ... (Dapatkan semua elemen lain berdasarkan ID)

        // 2. Tambahkan event listener ke setiap tombol "Detail" di katalog
        document.querySelectorAll('.detail-button').forEach(button => {
            button.addEventListener('click', function() {
                // Asumsi: Data disimpan dalam data attribute pada tombol
                const data = JSON.parse(this.getAttribute('data-peralatan'));

                // 3. Isi Konten Modal
                modalImage.src = data.foto_url;
                modalMerek.textContent = data.merek;
                document.getElementById('detail-deskripsi').textContent = data.deskripsi;
                document.getElementById('detail-tersedia').textContent = data.unit_tersedia + ' Unit';
                document.getElementById('detail-harga').innerHTML = `Rp ${formatRupiah(data.harga)} <span class="text-base font-normal text-gray-500">/ hari</span>`;

                // 4. Tampilkan Modal
                modal.classList.remove('hidden');
            });
        });

        // Helper untuk format rupiah (Anda harus mendefinisikan ini di scope global)
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0 }).format(Number(angka));
        }

        // 5. Logika Tutup Modal (Jika tidak menggunakan library seperti Flowbite)
        document.querySelector('[data-modal-hide="detail-peralatan-modal"]').addEventListener('click', function() {
            modal.classList.add('hidden');
        });

        // 6. Tutup Modal saat klik di luar area modal
        modal.addEventListener('click', function(e) {
            if (e.target.id === 'detail-peralatan-modal') {
                modal.classList.add('hidden');
            }
        });
    });
    </script>


</x-page-template>
