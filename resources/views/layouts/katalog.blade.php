<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Katalog Rental Console</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-900">

    {{-- NAVBAR --}}
    <nav class="w-full py-4 bg-transparent">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div href="/" class="">
                <x-main-logo/>
            </div>

            <div>
                <div>
                    <a
                        href="{{ url('/katalog') }}"
                        class="inline-block font-bold tracking-wide px-5 py-2.5 bg-[#ffa602] border-[#19140035] hover:border-[#1915014a] border text-[#000000]
                        hover:text-[#ffffff] rounded-xl text-sm leading-none transition"
                    >
                        Katalog
                    </a>
                    @auth
                        @if (Auth::user()->roles === 'admin')
                            <a
                                href="{{ url('/dashboard') }}"
                                class="inline-block font-bold tracking-wide px-5 py-2.5 bg-[#ffa602] border-[#19140035] hover:border-[#1915014a] border text-[#000000]
                                hover:text-[#ffffff] rounded-xl text-sm leading-none transition"
                            >
                                Dashboard
                            </a>
                        @endif

                        <a
                            href="{{ url('/histori-rental') }}"
                            class="inline-block font-bold tracking-wide px-5 py-2.5 bg-[#ffa602] border-[#19140035] hover:border-[#1915014a] border text-[#000000]
                            hover:text-[#ffffff] rounded-xl text-sm leading-none transition"
                        >
                            Histori Pemesanan
                        </a>


                    @else

                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 text-md">Log in &raquo;</a>

                    @endauth
                </div>
            </div>
        </div>
    </nav>
  <section class="bg-yellow-100 pt-10 pb-20 relative overflow-hidden">
    <div class="max-w-5xl mx-auto text-center px-6">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">
        Konsol Terbaik Menemani Waktu Santaimu
      </h1>
      <p class="text-gray-600 mb-6">
        PlayStation • Xbox • Nintendo • VR
      </p>

      <div class="flex justify-center">
        <div class="bg-white shadow-lg rounded-full flex items-center overflow-hidden w-full max-w-md">
          <input type="text" placeholder="Cari console..."
            class="px-4 py-2 w-full focus:outline-none" id="search-input">
          <button class="bg-red-500 text-white px-6 py-2 font-medium">Cari</button>
        </div>
      </div>
    </div>
  </section>

  <div class="flex justify-center mt-8 mb-6 space-x-4">
    <button class="px-4 py-2 bg-red-500 text-white rounded-full font-medium" data-filter="semua">Semua</button>
    <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-full" data-filter="console">Console</button>
    <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-full" data-filter="vr">VR</button>
    <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-full" data-filter="display">Display</button>
  </div>

  <section class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto px-6 mb-20">

    <!-- PS4 -->
    @foreach ($allJenis as $jenis)
        <div class="bg-white rounded-xl shadow-md p-4 hover:shadow-xl transition" data-kategori="{{ $jenis->kategori }}"  data-searchable="{{ strtolower($jenis->merek) }} {{ strtolower($jenis->deskripsi) }}">
        <img src="{{ asset('storage/jenis_peralatan/' . $jenis->foto_peralatan) }}"
        class="rounded-lg mb-4 w-full h-48 object-cover">

        <h2 class="text-xl font-semibold mb-2">{{ $jenis->merek }}</h2>
        <p class="text-gray-600 text-sm mb-4">
            {{ $jenis->deskripsi }}
        </p>
        <span class="text-sm
            @if ($jenis->stok_tersedia > 0) text-green-700
            @else text-red-500
            @endif
            ">Stok Tersedia : {{ $jenis->stok_tersedia }}</span>

        <div class="flex justify-between items-center">
            <span class="text-lg font-bold hargaPerHari">{{ $jenis->harga_rental_per_hari }}</span>
            <button class="text-white px-4 py-2 rounded-lg
             @if ($jenis->stok_tersedia > 0) bg-blue-600 hover:bg-blue-400"
             @else bg-gray-400 cursor-not-allowed" disabled
             @endif
             >Sewa</button>
        </div>
        </div>
    @endforeach
  </section>

</body>
<script>
    const formatRupiah = (angka) => {
        new Intl.NumberFormat('id-ID').format(angka);
        const formattedNumber = new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(Number(angka));

        return `Rp. ${formattedNumber} / hari`;
    }

    const searchInput = document.getElementById('search-input');
    const filterButtons = document.querySelectorAll('[data-filter]');
    const allCards = document.querySelectorAll('.rounded-xl.shadow-md');

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
        const hargaElements = document.querySelectorAll('.hargaPerHari');
        hargaElements.forEach(span => {
            const rawValue = span.textContent.trim();
            span.textContent = formatRupiah(rawValue);
        });

        searchInput.addEventListener('input', applyFilters);

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-red-500', 'text-white', 'filter-active');
                    btn.classList.add('bg-gray-200');
                });

                this.classList.add('bg-red-500', 'text-white', 'filter-active');
                this.classList.remove('bg-gray-200');

                applyFilters();
            });
        });

        // Terapkan filter awal pada kategori 'Semua'
        document.querySelector('[data-filter="semua"]').click();
    });
</script>
</html>
