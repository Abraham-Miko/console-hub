<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Histori Rental</title>
</head>
<body>

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

    <div class="bg-yellow-50 py-10 border-b border-gray-200">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Riwayat Peminjaman Anda</h2>
        </div>
    </div>

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

        document.addEventListener('DOMContentLoaded', function() {
            const hargaElements = document.querySelectorAll('.total_biaya');
            const detailBtn = document.getElementById('')
            hargaElements.forEach(span => {
                const rawValue = span.textContent.trim();
                span.textContent = formatRupiah(rawValue);
            });
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
</body>
</html>
