<x-page-template>
    {{-- NAVBAR --}}
    <nav class="w-full py-4 bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-6 flex justify-between items-center max-w-7xl">
            <div href="/" class="text-gray-900 font-extrabold tracking-widest">
                <x-main-logo/>
            </div>

            <div>
                <div class="flex items-center">
                    <a
                        href="{{ url('/katalog') }}"
                        class="inline-block font-bold tracking-wide px-4 py-2 text-[#ffa602] hover:text-[#e09100] text-sm leading-none transition duration-300 mr-4 border-b-2 border-transparent hover:border-[#ffa602]"
                    >
                        Katalog
                    </a>

                    @auth
                        {{-- Dropdown Menu BARU (Menggunakan Tampilan Avatar dan Dark Mode) --}}
                        <div class="relative inline-block text-left group">
                            {{-- Button pemicu diubah menjadi ikon/avatar --}}
                            <button
                                id="user-menu-button"
                                data-dropdown-toggle="user-dropdown"
                                type="button"
                                class="inline-flex items-center p-1 rounded-full text-sm font-bold tracking-wide transition duration-300 focus:outline-none focus:ring-2 focus:ring-[#ffa602]"
                                aria-expanded="false"
                                data-dropdown-placement="bottom-end"
                            >
                                {{-- Ganti dengan Avatar Pengguna --}}

                                <img
                                    class="w-10 h-10 rounded-full border-2 border-gray-300 hover:border-[#ffa602] transition duration-300"
                                    src="{{ asset('images/ANONYMOUS USER PROFILE.jpg') }}"
                                    alt="Avatar Pengguna"
                                >
                            </button>

                            {{-- Dropdown content diubah tampilannya menjadi dark mode --}}
                            <div
                                id="user-dropdown"
                                {{-- Kelas diubah ke latar belakang gelap dan padding yang sesuai --}}
                                class="z-50 hidden absolute right-0 mt-2 w-72 origin-top-right bg-gray-50 border border-gray-900 divide-y divide-gray-700 rounded-lg shadow-2xl"
                                role="menu"
                                aria-orientation="vertical"
                                aria-labelledby="user-menu-button"
                            >
                                {{-- Bagian Info Pengguna (Nama & Email) --}}
                                <div class="px-4 py-4" role="none">
                                    <p class="text-lg font-extrabold text-black mb-1 leading-tight">
                                        {{ Auth::user()->nama_depan }} {{ Auth::user()->nama_belakang }}
                                    </p>
                                    {{-- Asumsi Anda memiliki kolom 'email' --}}
                                    <p class="text-sm font-semibold text-[#ffa602]">
                                        {{ Auth::user()->email }}
                                    </p>
                                </div>
                                <div class="py-1" role="none">
                                    {{-- Menu Admin --}}
                                    @if (Auth::user()->roles === 'admin')
                                        <a href="{{ url('/dashboard') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
                                            <svg class="w-5 h-5 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            Dashboard Admin
                                        </a>
                                    @endif

                                    {{-- START: FITUR PROFIL BARU --}}
                                    @if (Auth::user()->roles === 'admin')
                                        <a href="{{ url('/profile') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
                                            <svg class="w-5 h-5 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            Profil Saya
                                        </a>
                                    @else
                                        <a href="{{ url('/user-profile') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
                                            <svg class="w-5 h-5 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            Profil Saya
                                        </a>
                                    @endif
                                    {{-- END: FITUR PROFIL BARU --}}

                                    {{-- Menu Histori --}}
                                    <a href="{{ url('/histori-rental') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
                                        <svg class="w-5 h-5 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Histori Pemesanan
                                    </a>


                                    {{-- Logout --}}
                                    <form method="POST" action="{{ route('logout') }}" class="block w-full text-left" role="none">
                                        @csrf
                                        {{-- Menggunakan flex dan justify-between untuk menempatkan tombol "Keluar" di kanan bawah --}}
                                        <button type="submit" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-red-500 hover:text-white transition duration-150 w-full">
                                            <svg class="w-5 h-5 mr-3 hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3v-4a3 3 0 013-3h3m0-3V6a3 3 0 013-3h4a3 3 0 013 3v2"></path></svg>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block font-bold tracking-wide px-5 py-2.5 bg-[#ffa602] text-gray-900 rounded-xl text-sm leading-none transition duration-300 shadow-md hover:bg-[#e09100]"
                        >
                            Log in &raquo;
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <section class="bg-gray-100 pt-16 pb-16  relative overflow-hidden border-b border-gray-200">
        <div class="max-w-6xl mx-auto text-center px-6 relative z-10">
            <h1 class="text-5xl md:text-4xl font-extrabold mb-4 text-gray-900 uppercase tracking-wider leading-tight">
                Riwayat Pesananan
            </h1>
            {{-- SEARCH BAR --}}
            <div class="flex justify-center">
                <div class="relative w-full max-w-md">
                    <input
                        type="text"
                        placeholder="Cari riwayat pesananmu..."
                        class="w-full pl-12 pr-3 py-2 bg-white text-gray-800 border border-gray-300 rounded-full text-md shadow-xl
                               focus:outline-none focus:ring-2 focus:ring-[#ffa602] focus:border-[#ffa602]
                               transition duration-300 placeholder-gray-500"
                        id="search-input"
                    >
                    <svg class="absolute left-5 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    @if (session()->has('success'))
        <div id="alert-border-1" class="flex items-center p-4 mb-4 text-sm text-green-400 border-t-4 border-green-500 bg-gray-700 rounded-lg" role="alert">

            {{-- SVG Icon untuk tanda centang / sukses --}}
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h4a1 1 0 0 1 0 2Zm1.713-3.693a1 1 0 0 1-1.42 1.42l-3-3a1 1 0 0 1 1.42-1.42l2.364 2.364Z"/>
            </svg>

            <div class="ms-3 text-sm font-medium">
                <span class="font-bold">Berhasil!</span> {{ session()->get('success') }}
            </div>

            {{-- Tombol Tutup (Silang) --}}
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-gray-700 text-green-400 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-gray-600 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-border-1" aria-label="Close">
                <span class="sr-only">Dismiss</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
    <div class="container mx-auto px-4 mt-8">
        @foreach ($selectHistoriUser as $histori)
            <div class="bg-white p-4 md:p-6 shadow-md rounded-lg mb-6 border border-gray-100 transition duration-300 hover:shadow-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4 flex-1">
                        <img src="{{ asset('storage/jenis_peralatan/' . $histori->unitPeralatan->jenis_peralatan->foto_peralatan) }}" alt="{{ $histori->unitPeralatan->jenis_peralatan->merek }}" class="w-20 h-20 object-cover rounded-md flex-shrink-0">

                        <div class="min-w-0">
                            <h4 class="text-xl font-semibold text-gray-800">{{ $histori->unitPeralatan->jenis_peralatan->merek }}</h4>
                            <p class="text-sm text-gray-500 mt-1">
                                <span class="font-medium">Pinjam:</span> {{ $histori->tgl_mulai }}
                                <span class="mx-2">|</span>
                                <span class="font-medium">Kembali:</span> {{ $histori->tgl_selesai }}
                            </p>

                            <span class="inline-flex items-center px-3 py-1 mt-2 text-xs font-medium rounded-full
                            @if ($histori->status_pemesanan === 'selesai') bg-green-100 text-green-800"> 🟢
                            @elseif ($histori->status_pemesanan === 'dipesan') bg-indigo-100 text-indigo-600"> 🟣
                            @elseif ($histori->status_pemesanan === 'dirental') bg-yellow-100 text-yellow-800"> 🟡
                            @else bg-red-200 text-red-800"> 🔴
                            @endif

                            {{ ucfirst($histori->status_pemesanan) }}
                            </span>
                        </div>
                    </div>

                    <div class="text-right flex flex-col items-end space-y-2 ml-4">
                        <p class="text-sm text-gray-600">Total Biaya:</p>
                        <h4 class="text-2xl font-bold text-red-600 total_biaya">{{ $histori->total_biaya }}</h4>

                        <button class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition duration-150" onclick="modalBtn({{ $histori->id }})">
                            Detail
                        </button>
                    </div>

                </div>
            </div>
        @endforeach
        <div id="detail-modal-container"></div>
    </div>

    <script>
        const formatRupiah = (angka) => {
            new Intl.NumberFormat('id-ID').format(angka);
            const formattedNumber = new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(Number(angka));

            return `Rp. ${formattedNumber}`;
        }

        // Variabel yang tidak relevan dengan histori-rental telah dihapus/dikomentari
        // const searchInput = document.getElementById('search-input'); // Diambil di bawah
        // const filterButtons = document.querySelectorAll('.filter-button');
        // const allCards = document.querySelectorAll('.product-card');

        /**
         * Fungsi untuk menerapkan filter pencarian pada daftar riwayat pemesanan.
         */
        function applySearchFilter() {
            // 1. Ambil nilai input pencarian
            const searchInput = document.getElementById('search-input');
            const searchTerm = searchInput.value.toLowerCase().trim();

            // 2. Ambil semua elemen riwayat pemesanan (menggunakan kelas kontainer yang spesifik)
            // Kelas: bg-white p-4 md:p-6 shadow-md rounded-lg mb-6
            const historiItems = document.querySelectorAll('.bg-white.p-4.md\\:p-6.shadow-md.rounded-lg.mb-6');

            // 3. Iterasi dan filter
            historiItems.forEach(item => {
                // Dapatkan nama barang, yang terletak di dalam tag h4 di dalam item
                const itemNameElement = item.querySelector('h4');
                let itemName = '';

                if (itemNameElement) {
                    itemName = itemNameElement.textContent.toLowerCase().trim();
                }

                // Cek apakah nama barang mengandung istilah pencarian
                if (itemName.includes(searchTerm)) {
                    item.style.display = ''; // Tampilkan elemen
                } else {
                    item.style.display = 'none'; // Sembunyikan elemen
                }
            });
        }


        document.addEventListener('DOMContentLoaded', function() {
            const hargaElements = document.querySelectorAll('.total_biaya');
            // const detailBtn = document.getElementById('') // Variabel tidak digunakan
            hargaElements.forEach(span => {
                const rawValue = span.textContent.trim();
                span.textContent = formatRupiah(rawValue);
            });

            // Tambahkan event listener untuk input pencarian setelah DOM dimuat
            const searchInput = document.getElementById('search-input');
            if (searchInput) {
                searchInput.addEventListener('keyup', applySearchFilter);
            }
        });


        function modalBtn(id) {
            const modalContain = document.getElementById('detail-modal-container');
            function modalRender(pemesananData, containerEl) {
                const unit = pemesananData.unit_peralatan;
                const jenis = unit.jenis_peralatan;
                const storageBasePath = "{{ asset('storage/pemesanan') }}";
                const formatRupiahEdit = (angka) => {
                    return new Intl.NumberFormat('id-ID').format(angka);
                }
                const statusPemesanan = pemesananData.status_pemesanan;
                const qrKonversiRouteTemplate = '{{ route('pemesanan.qr.konversi', ['token' => ':token', 'return_to' => url()->current()]) }}';
                const modalHTML = `

                    <div id="verifikasi-modal" tabindex="-1"
                    class="fixed inset-0 z-50 bg-black/50 flex justify-center items-center">

                    <div class="relative w-full max-w-2xl">
                        <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-300">

                            <div class="flex justify-between items-center border-b border-gray-200 pb-3 mb-4">
                                <h3 class="text-2xl font-bold text-gray-900">
                                    Detail Pemesanan
                                </h3>
                                <span class="text-sm font-semibold text-green-700 bg-green-100 px-3 py-1 rounded-full">
                                    Pemesanan # ${pemesananData.id}
                                </span>
                            </div>

                            <div class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm text-gray-700">

                                <div class="col-span-1 border-r pr-6">
                                    <p class="font-bold mb-2 text-indigo-600">DETAIL ASET</p>
                                    <p><strong>Model:</strong> ${jenis.merek} (${unit.warna})</p>
                                    <p><strong>Nomor Seri:</strong> ${unit.nomor_seri}</p>
                                    <p><strong>Durasi:</strong> ${pemesananData.durasi_rental} hari</p>
                                </div>

                                <div class="col-span-1">
                                    <p class="font-bold mb-2 text-indigo-600">DETAIL PENYEWA</p>
                                    <p><strong>Penyewa:</strong> ${pemesananData.nama_penyewa}</p>
                                    <p><strong>NIK:</strong> ${pemesananData.nik_penyewa}</p>
                                    <p><strong>Jaminan:</strong> ${pemesananData.jaminan_penyewa.toUpperCase()}</p>
                                </div>

                                <div class="col-span-2 pt-4 border-t border-gray-200 mt-4">
                                    <p class="font-bold mb-2 text-gray-900">Bukti Dokumen KTP/SIM:</p>
                                    <img src="${storageBasePath}/${pemesananData.foto_ktp_sim}"
                                        alt="Foto Dokumen Jaminan"
                                        class="rounded-lg w-full h-80 object-cover border border-gray-300"/>
                                </div>
                            </div>

                            <div class="mt-6 flex justify-between items-center border-t border-gray-200 pt-4">

                                <div class="text-lg font-bold">
                                    Total: <span class="text-green-600">
                                        Rp ${formatRupiahEdit(pemesananData.total_biaya)}
                                    </span>
                                </div>

                                <div class="flex space-x-3">

                                    <a href="${qrKonversiRouteTemplate.replace(':token', pemesananData.verification_token)}"
                                    class="text-sm text-gray-700 hover:text-gray-900 px-4 py-2 border border-gray-300 rounded-lg flex items-center">
                                        <svg class="w-6 h-6 text-green-800 dark:text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/>
                                        </svg>
                                        Download QR
                                    </a>

                                    <button data-modal-hide="verifikasi-modal" type="button" onclick="window.location.reload()" class="text-sm text-white hover:text-gray-300 px-4 py-2 border border-gray-300 rounded-lg flex items-center bg-red-600">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;
                containerEl.innerHTML = '';
                containerEl.innerHTML = modalHTML;
            }

            modalContain.innerHTML = `
                <div class="fixed inset-0 z-50 bg-black/50 flex justify-center items-center">
                    <div class="text-center">
                        <div role="status">
                            <svg aria-hidden="true"
                                class="inline w-10 h-10 animate-spin fill-indigo-500 text-gray-400"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">

                                {{-- Path 1: Latar Belakang Lingkaran --}}
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor"/>

                                {{-- Path 2: Bagian yang Berputar --}}
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.8710 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.8130 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.0830 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                `;

                fetch(`/api/riwayat/detail/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        modalRender(data.pemesanan, modalContain)
                    }
                )
            }
        </script>
</x-page-template>
