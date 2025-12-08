<x-app-layout>
    @section('title', 'Daftar Unit Peralatan')

    {{-- NAVBAR --}}

    <div class="py-12">
        <div class="rounded-lg p-6">
            <div class="sm:ml-64 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-10">
                    <p class="text-4xl font-semibold dark:text-white">Daftar Unit Peralatan</p>
                    <div class="flex space-x-3">
                        {{-- TOMBOL HAPUS MASSAL BARU --}}
                        <x-danger-button data-modal-target="bulk-delete-modal" data-modal-toggle="bulk-delete-modal" class="mr-2">Hapus Massal</x-danger-button>

                        <x-secondary-button data-modal-target="create-modal" data-modal-toggle="create-modal">+ Tambah Peralatan Baru</x-secondary-button>
                    </div>
                </div>

                @if (session()->has('success'))
                    <div id="alert-border-1" class="flex items-center p-4 mb-4 text-sm text-green-400 border-t-4 border-green-500 bg-gray-700 rounded-lg" role="alert">

                        {{-- SVG Icon untuk tanda centang / sukses --}}
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h4a1 1 0 0 1 0 2Zm1.713-3.693a1 1 0 0 1-1.42 1.42l-3-3a1 1 0 0 1 1.42-1.42l2.364 2.364Z"/>
                        </svg>

                        <div class="ms-3 text-sm font-medium">
                            {{ session()->get('success') }}
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

                @if (session()->has('error'))
                    <div id="alert-border-2" class="flex items-center p-4 mb-4 text-sm text-red-400 border-t-4 border-red-500 bg-gray-700 rounded-lg" role="alert">

                        {{-- SVG Icon untuk error --}}
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 16a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-3.5a1 1 0 0 1-2 0V7a1 1 0 1 1 2 0v5.5Z"/>
                        </svg>

                        <div class="ms-3 text-sm font-medium">
                            <span class="font-bold">Gagal!</span> {{ session()->get('error') }}
                        </div>

                        {{-- Tombol Tutup (Silang) --}}
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-gray-700 text-red-400 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-gray-600 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-border-2" aria-label="Close">
                            <span class="sr-only">Dismiss</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                @endif

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table id="search-table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Jenis Peralatan</th>
                                <th scope="col" class="px-6 py-3">Nomor Seri</th>
                                <th scope="col" class="px-6 py-3">Warna</th>
                                <th scope="col" class="px-6 py-3">Kondisi</th>
                                <th scope="col" class="px-6 py-3">Status Peralatan</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unit_peralatans as $unit_peralatan)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $unit_peralatan->jenis_peralatan->merek }}
                                </td>
                                <td class="px-6 py-4">{{ $unit_peralatan->nomor_seri }}</td>
                                <td class="px-6 py-4">{{ $unit_peralatan->warna }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    @if($unit_peralatan->kondisi == 'baik') text-green-800 dark:text-green-300
                                    @else text-red-800 dark:text-red-500
                                    @endif">
                                        {{ ucfirst($unit_peralatan->kondisi) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    @if($unit_peralatan->status_peralatan == 'tersedia') bg-green-800 text-green-300
                                    @elseif($unit_peralatan->status_peralatan == 'dipesan') bg-blue-800 text-blue-300
                                    @elseif($unit_peralatan->status_peralatan == 'dirental') bg-purple-800 text-purple-300
                                    @else bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-300
                                    @endif">
                                        {{ ucfirst($unit_peralatan->status_peralatan) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex space-x-2">
                                    <button data-modal-target="edit-modal-{{ $unit_peralatan->id_unit_peralatan }}" data-modal-toggle="edit-modal-{{ $unit_peralatan->id_unit_peralatan }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>

                                    <form action="{{ route('unit_peralatan.destroy', $unit_peralatan->id_unit_peralatan) }}" id="delete-form-{{ $unit_peralatan->id_unit_peralatan }}" method="POST" onsubmit="event.preventDefault(); confirmDelete('delete-form-{{ $unit_peralatan->id_unit_peralatan }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @include('admin.unit_peralatan.edit-modal',['unit_peralatan' => $unit_peralatan])
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
@include('admin.unit_peralatan.create-modal')

{{-- PENAMBAHAN: MODAL HAPUS MASSAL --}}
<div id="bulk-delete-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 justify-center z-50 items-center w-full md:inset-0 max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-gray-800 border border-gray-700 rounded-lg shadow-2xl p-4 md:p-6 z-[10001]">
            <div class="flex items-center justify-between border-b border-gray-700 pb-4 md:pb-5">
                <h3 class="text-xl font-medium text-red-400">
                    Hapus Data Massal ⚠️
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="bulk-delete-modal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <form id="bulk-delete-form" action="{{ route('unit_peralatan.bulk_destroy') }}" method="POST" onsubmit="event.preventDefault(); confirmBulkDelete();">
                @csrf
                @method('DELETE')

                <div class="grid gap-4 py-4 md:py-6">
                    <div class="col-span-full">
                        <label for="bulk_delete_field" class="block mb-2.5 text-sm font-medium text-gray-300">Hapus berdasarkan Kriteria</label>
                        <select id="bulk_delete_field" name="field"
                            class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-red-500 focus:border-red-500 placeholder:text-gray-400" required>
                            <option value="">-- Pilih Kriteria Penghapusan --</option>
                            <option value="kondisi">Kondisi (Baik/Rusak)</option>
                            <option value="status_peralatan">Status Peralatan (Tersedia/Dirental/dll.)</option>
                            <option value="id_jenis_peralatan">Jenis Peralatan (Berdasarkan Merek)</option>
                        </select>
                    </div>

                    <div class="col-span-full" id="bulk_delete_value_container">
                        <label for="bulk_delete_value" class="block mb-2.5 text-sm font-medium text-gray-300">Nilai Kriteria</label>

                        {{-- Field yang akan diisi oleh JS berdasarkan pilihan kriteria --}}
                        <select id="bulk_delete_value" name="value"
                            class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-red-500 focus:border-red-500 placeholder:text-gray-400" required disabled>
                            <option value="">Pilih kriteria di atas terlebih dahulu</option>
                        </select>

                        <p class="mt-2 text-xs text-red-400 font-semibold">PERINGATAN! Aksi ini tidak dapat dikembalikan. Data akan dihapus secara permanen.</p>
                    </div>

                </div>

                <div class="flex items-center space-x-4 border-t border-gray-700 pt-4 md:pt-6">
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-500 font-medium leading-5 rounded-lg text-sm px-4 py-2.5 focus:outline-none">
                        {{ __('Hapus Semua Data Terkait') }}
                    </button>

                    <button data-modal-hide="bulk-delete-modal" type="button"
                        class="text-white bg-gray-700 border border-gray-600 hover:bg-gray-600 hover:text-white focus:ring-4 focus:ring-gray-500 font-medium leading-5 rounded-lg text-sm px-4 py-2.5 focus:outline-none">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- AKHIR PENAMBAHAN MODAL HAPUS MASSAL --}}

<script>
    // Datatables Init (Diperbarui untuk Sorting)
    if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#search-table", {
            searchable: true,
            sortable: true, // Mengaktifkan sorting
            columns: [
                // Kolom 'Aksi' (index 5) diatur agar tidak dapat diurutkan
                { select: 5, sortable: false }
            ]
        });
    }

    // Fungsi konfirmasi hapus satuan (sudah ada)
    function confirmDelete(formId) {
        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Anda akan menghapus data ini secara permanen dan tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",

            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById(formId);
                form.submit();
                Swal.fire({
                    title: 'Menghapus...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }
        });
    }

    // PENAMBAHAN: LOGIKA HAPUS MASSAL (Client-side)
    const allJenisPeralatans = @json($jenisPeralatans ?? []);

    const fieldSelect = document.getElementById('bulk_delete_field');
    const valueSelect = document.getElementById('bulk_delete_value');

    fieldSelect.addEventListener('change', function() {
        const selectedField = this.value;
        valueSelect.innerHTML = '<option value="">-- Pilih Nilai --</option>'; // Reset
        valueSelect.disabled = true;

        if (selectedField) {
            valueSelect.disabled = false;
            let options = '';

            if (selectedField === 'kondisi') {
                options = `
                    <option value="baik">Baik</option>
                    <option value="rusak">Rusak</option>
                `;
            } else if (selectedField === 'status_peralatan') {
                options = `
                    <option value="tersedia">Tersedia</option>
                    <option value="dipesan">Dipesan</option>
                    <option value="dirental">Dirental</option>
                    <option value="perawatan">Perawatan</option>
                `;
            } else if (selectedField === 'id_jenis_peralatan') {
                allJenisPeralatans.forEach(jp => {
                    options += `<option value="${jp.id_jenis_peralatan}">${jp.merek} (${jp.kategori})</option>`;
                });
            }

            valueSelect.innerHTML += options;
        }
    });

    // Fungsi konfirmasi Hapus Massal (menargetkan form bulk-delete-form)
    function confirmBulkDelete() {
        // Ambil teks kriteria dan nilai untuk pesan konfirmasi
        const field = fieldSelect.options[fieldSelect.selectedIndex].text;
        const value = valueSelect.options[valueSelect.selectedIndex].text;

        Swal.fire({
            title: "Hapus Massal Data?",
            text: `Anda akan menghapus SEMUA unit peralatan dengan Kriteria: "${field}" = "${value}". Tindakan ini TIDAK dapat dibatalkan!`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Ya, Hapus Massal!",
            cancelButtonText: "Batal",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('bulk-delete-form');
                form.submit();
                Swal.fire({
                    title: 'Menghapus...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }
        });
    }

</script>
