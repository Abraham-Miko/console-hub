<x-app-layout>
    @section('title', 'Daftar Jenis Peralatan')

    {{-- NAVBAR --}}

    <div class="py-12">
        <div class="rounded-lg p-6">
            <div class="sm:ml-64 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-10">
                    <p class="text-4xl font-semibold dark:text-white">Jenis Peralatan</p>
                    <x-secondary-button data-modal-target="create-modal" data-modal-toggle="create-modal">+ Tambah Jenis Peralatan</x-secondary-button>
                </div>

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
                @elseif (session()->has('error'))
                    <div id="alert-border-1" class="flex items-center p-4 mb-4 text-sm text-red-400 border-t-4 border-red-500 bg-gray-700 rounded-lg" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                        </svg>

                        <div class="ms-3 text-sm font-medium">
                            <span class="font-bold">Gagal!</span> {!! session('error') !!}
                        </div>

                        {{-- Tombol Tutup (Silang) --}}
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-gray-700 text-red-400 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-gray-600 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-border-1" aria-label="Close">
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
                                <th scope="col" class="px-6 py-3">Gambar</th>
                                <th scope="col" class="px-6 py-3">Kategori</th>
                                <th scope="col" class="px-6 py-3">Merek</th>
                                <th scope="col" class="px-6 py-3">Harga/hari</th>
                                <th scope="col" class="px-6 py-3">Deskripsi</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenis_peralatans as $jenis_peralatan)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    <img src="{{ asset('storage/jenis_peralatan/' . $jenis_peralatan->foto_peralatan) }}" class="w-32 h-32 object-cover rounded" alt="{{ $jenis_peralatan->merek }}">
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ ucwords($jenis_peralatan->kategori) }}
                                </td>
                                <td class="px-6 py-4">{{ $jenis_peralatan->merek }}</td>
                                <td class="px-6 py-4">Rp.{{ $jenis_peralatan->harga_rental_per_hari }}</td>
                                <td class="px-6 py-4">{{ $jenis_peralatan->deskripsi }}</td>
                                {{-- <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    @if($jenis_mobil->status_kendaraan == 'tersedia') bg-green-100 text-green-800
                                    @elseif($jenis_mobil->status_kendaraan == 'dirental') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                        {{ ucfirst($jenis_mobil->status_kendaraan) }}
                                    </span>
                                </td> --}}
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2 items-center">
                                        <button data-modal-target="edit-modal-{{ $jenis_peralatan->id_jenis_peralatan }}" data-modal-toggle="edit-modal-{{ $jenis_peralatan->id_jenis_peralatan }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>

                                        <form action="{{ route('jenis_peralatan.destroy', $jenis_peralatan->id_jenis_peralatan) }}" method="POST" id="delete-form-{{ $jenis_peralatan->id_jenis_peralatan }}" onsubmit="event.preventDefault(); confirmDelete('delete-form-{{ $jenis_peralatan->id_jenis_peralatan }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                            @include('admin.jenis_peralatan.edit-modal',['jenis_peralatan' => $jenis_peralatan])
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@include('admin.jenis_peralatan.create-modal')
</x-app-layout>

<script>
    // Datatables Init
    if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#search-table", {
            searchable: true,
            sortable: false
        });
    }

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
</script>
