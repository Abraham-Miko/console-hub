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
                        href="{{ url('/histori-rental') }}"
                        class="inline-block font-bold tracking-wide px-4 py-2 text-[#ffa602] hover:text-[#e09100] text-sm leading-none transition duration-300 mr-4 border-b-2 border-transparent hover:border-[#ffa602]"
                    >
                        Histori Pemesanan
                    </a>

                    @auth
                        {{-- Pengguna TELAH login (User atau Admin) --}}

                        {{-- Dropdown Menu (Menggunakan Tampilan Avatar dan Dark Mode/Abu-abu) --}}
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

                            {{-- Dropdown content --}}
                            <div
                                id="user-dropdown"
                                class="z-50 hidden absolute right-0 mt-2 w-72 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-lg shadow-2xl"
                                role="menu"
                                aria-orientation="vertical"
                                aria-labelledby="user-menu-button"
                            >
                                {{-- Bagian Info Pengguna (Nama & Email) --}}
                                <div class="px-4 py-4" role="none">
                                    <p class="text-lg font-extrabold text-gray-900 mb-1 leading-tight">
                                        {{ Auth::user()->nama_depan }} {{ Auth::user()->nama_belakang }}
                                    </p>
                                    <p class="text-sm font-semibold text-[#ffa602]">
                                        {{ Auth::user()->email }}
                                    </p>
                                </div>

                                <div class="py-1" role="none">

                                    {{-- Opsi Khusus Admin: Tampil jika roles adalah 'admin' --}}
                                    @if (Auth::user()->roles === 'admin')
                                        <a href="{{ url('/dashboard') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
                                            <svg class="w-5 h-5 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            Dashboard Admin
                                        </a>
                                        {{-- <a href="{{ url('/profile') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
                                            <svg class="w-5 h-5 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            Profil Saya
                                        </a> --}}
                                    @endif

                                    <a href="{{ url('/user-profile') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
                                        <svg class="w-5 h-5 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        Profil Saya
                                    </a>

                                    @if (Auth::user()->roles === 'user' || Auth::user()->roles === 'admin')
                                    {{-- Opsi Umum (Histori Pemesanan) --}}
                                    <a href="{{ url('/histori-rental') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
                                        <svg class="w-5 h-5 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Histori Pemesanan
                                    </a>

                                    {{-- Opsi Umum (Keluar) --}}
                                    <form method="POST" action="{{ route('logout') }}" class="block w-full text-left" role="none">
                                        @csrf
                                        <button type="submit" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-red-500 hover:text-white transition duration-150 w-full">
                                            <svg class="w-5 h-5 mr-3 hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3v-4a3 3 0 013-3h3m0-3V6a3 3 0 013-3h4a3 3 0 013 3v2"></path></svg>
                                            Keluar
                                        </button>
                                    </form>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block font-bold tracking-wide px-5 py-2.5 bg-[#ffa602] text-gray-900 hover:text-white rounded-xl text-sm leading-none transition duration-300 shadow-md"
                        >
                            Log in &raquo;
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- HERO SECTION (TETAP SAMA) --}}
    <section class="bg-gray-100 pt-16 pb-28  relative overflow-hidden border-b border-gray-200">
        <div class="max-w-6xl mx-auto text-center px-6 relative z-10">
            <h1 class="text-5xl md:text-7xl font-extrabold mb-4 text-gray-900 uppercase tracking-wider leading-tight">
                Konsol Terbaik Menemani Waktu Santaimu
            </h1>
            <p class="text-gray-600 mb-8 text-xl font-light">
                PlayStation • Xbox • Nintendo • VR • Gaming Gear
            </p>

            {{-- SEARCH BAR --}}
            <div class="flex justify-center">
                <div class="relative w-full max-w-2xl">
                    <input
                        type="text"
                        placeholder="Cari console, VR, atau monitor impianmu..."
                        class="w-full pl-14 pr-6 py-4 bg-white text-gray-800 border border-gray-300 rounded-full text-lg shadow-xl
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

    {{-- KATEGORI FILTER (TETAP SAMA) --}}
    <div class="bg-white py-6 border-b border-gray-200 shadow-sm">
        <div class="flex justify-center max-w-7xl mx-auto px-6 space-x-4">
            <button class="filter-button px-5 py-2 bg-[#ffa602] text-gray-900 rounded-full font-medium transition duration-300 shadow-md" data-filter="semua">Semua</button>
            <button class="filter-button px-5 py-2 bg-gray-200 text-gray-700 hover:bg-gray-300 rounded-full transition duration-300" data-filter="console">Console</button>
            <button class="filter-button px-5 py-2 bg-gray-200 text-gray-700 hover:bg-gray-300 rounded-full transition duration-300" data-filter="vr">VR</button>
            <button class="filter-button px-5 py-2 bg-gray-200 text-gray-700 hover:bg-gray-300 rounded-full transition duration-300" data-filter="display">Display</button>
        </div>
    </div>

    {{-- GRID KATALOG PRODUK --}}
    <section class="bg-white py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto px-6 mb-20">

            @foreach ($allJenis as $jenis)
                {{-- Card Produk --}}
                <div class="product-card bg-white rounded-2xl p-5 border border-gray-200 shadow-lg transition-all duration-300 hover:shadow-xl hover:border-[#ffa602]"
                    data-kategori="{{ $jenis->kategori }}"
                    data-searchable="{{ strtolower($jenis->merek) }} {{ strtolower($jenis->deskripsi) }}"
                >
                    {{-- Gambar Produk --}}
                    <div class="h-48 mb-4 overflow-hidden rounded-xl border border-gray-300">

                        <img
                            src="{{ asset('storage/jenis_peralatan/' . $jenis->foto_peralatan) }}"
                            alt="Foto {{ $jenis->merek }}"
                            class="w-full h-full object-cover transition duration-500 hover:scale-105"
                        >
                    </div>

                    <h2 class="text-xl font-bold mb-1 text-gray-900">{{ $jenis->merek }}</h2>
                    <p class="text-gray-600 text-sm mb-3 h-10 overflow-hidden">
                        {{ $jenis->deskripsi }}
                    </p>

                    {{-- Stok dan Harga --}}
                    <div class="flex justify-between items-end mb-4 pt-2 border-t border-gray-200">
                        <span class="text-sm font-semibold
                            @if ($jenis->stok_tersedia > 0) text-green-600
                            @else text-red-500
                            @endif
                        ">
                            Stok Tersedia: {{ $jenis->stok_tersedia }}
                        </span>
                        {{-- Harga menggunakan warna aksen --}}
                        <span class="text-md font-extrabold text-black hargaPerHari">
                            {{ $jenis->harga_rental_per_hari }}
                        </span>
                    </div>

                    {{-- Tombol Sewa --}}
                    <a
                        href="{{ route('pemesanan.checkout', $jenis->id_jenis_peralatan) }}"
                        class="block w-full text-center py-3 rounded-xl font-bold transition duration-300
                        @if ($jenis->stok_tersedia > 0) bg-[#ffa602] text-gray-900 hover:text-white shadow-md
                        @else bg-gray-400 text-gray-600 hover:text-gray-600 cursor-not-allowed  pointer-events-none
                        @endif
                    ">
                        @if ($jenis->stok_tersedia > 0) Sewa Sekarang @else Stok Habis @endif
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Script JavaScript (TETAP SAMA) --}}


</x-page-template>

<script>
        // Fungsi Format Rupiah
        const formatRupiah = (angka) => {
            const formattedNumber = new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(Number(angka));
            return `Rp${formattedNumber},00 / hari`;
        }

        const searchInput = document.getElementById('search-input');
        const filterButtons = document.querySelectorAll('.filter-button');
        const allCards = document.querySelectorAll('.product-card');

        function applyFilters() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const activeCategory = document.querySelector('.filter-active')?.getAttribute('data-filter') || 'semua';

            allCards.forEach(card => {
                const cardCategory = card.getAttribute('data-kategori');
                const cardSearchData = card.getAttribute('data-searchable');

                const categoryMatch = activeCategory === 'semua' || cardCategory === activeCategory;
                const searchMatch = cardSearchData.includes(searchTerm);

                if (categoryMatch && searchMatch) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // 1. Format Rupiah
            const hargaElements = document.querySelectorAll('.hargaPerHari');
            hargaElements.forEach(span => {
                const rawValue = span.textContent.trim();
                span.textContent = formatRupiah(rawValue);
            });

            // 2. Event Listeners untuk Search dan Filter
            searchInput.addEventListener('input', applyFilters);

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Hapus style active dari semua tombol
                    filterButtons.forEach(btn => {
                        // Reset semua tombol ke style non-aktif (abu-abu)
                        btn.classList.remove('bg-[#ffa602]', 'text-gray-900', 'filter-active', 'shadow-md');
                        btn.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
                    });

                    // Tambahkan style active ke tombol yang diklik (warna aksen #ffa602)
                    this.classList.add('bg-[#ffa602]', 'text-gray-900', 'filter-active', 'shadow-md');
                    this.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');

                    applyFilters();
                });
            });

            // 3. Terapkan filter awal pada kategori 'Semua' (Simulasi klik)
            document.querySelector('[data-filter="semua"]').click();
        });
    </script>
