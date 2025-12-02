@props(['pemesanan'])

<div id="edit-modal-{{ $pemesanan->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full">

    <div class="relative p-4 w-full max-w-xl max-h-full">
        <div class="relative bg-gray-800 border border-gray-700 rounded-lg shadow-2xl p-4 md:p-6">

            <div class="flex items-center justify-between border-b border-gray-700 pb-4 md:pb-5">
                <h3 class="text-xl font-medium text-white">
                    Edit Pemesanan: {{ $pemesanan->id }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="edit-modal-{{ $pemesanan->id }}">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <form action="{{ route('pemesanan.update', $pemesanan->id) }}" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 grid-cols-2 py-4 md:py-6">

                    <div class="col-span-2 sm:col-span-1">
                        <label for="jenis_peralatan_id-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Pilih Model</label>
                        <select id="jenis_peralatan_id-{{ $pemesanan->id }}" required
                                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400">
                            <option value="" disabled selected>- Pilih Jenis Peralatan -</option>
                            @foreach ($allJenisPeralatans as $jenis)
                                <option value="{{ $jenis->id_jenis_peralatan }}"
                                    @if ($pemesanan->unitPeralatan->id_jenis_peralatan == $jenis->id_jenis_peralatan) selected @endif>
                                    {{ $jenis->merek }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="unit_peralatan_id-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Pilih Unit (Nomor Seri)</label>
                        <select id="unit_peralatan_id-{{ $pemesanan->id }}" name="id_unit_peralatan" required disabled
                                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400">
                            <option value="" disabled selected>- Pilih Model Dahulu -</option>
                            </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="nama_penyewa-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Nama Penyewa</label>
                        <input type="text" name="nama_penyewa" id="nama_penyewa-{{ $pemesanan->id }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: Sukma Dhika" required="" value="{{ old('nama_penyewa', $pemesanan->nama_penyewa) }}">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="nik_penyewa-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">NIK</label>
                        <input type="text" name="nik_penyewa" id="nik_penyewa-{{ $pemesanan->id }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: 3505152006060002" required="" minlength="16" maxlength="18" value="{{ old('nik_penyewa', $pemesanan->nik_penyewa) }}">
                    </div>

                    <div class="col-span-2">
                        <label for="alamat_penyewa-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Alamat</label>
                        <input type="textarea" name="alamat_penyewa" id="alamat_penyewa-{{ $pemesanan->id }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: Jl. Remaja RT 11 RW 08 Purwosari" required="" value="{{ old('alamat_penyewa', $pemesanan->alamat_penyewa) }}">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="telepon_penyewa-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">No. Telepon</label>
                        <input type="text" name="telepon_penyewa" id="telepon_penyewa-{{ $pemesanan->id }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: 08578..." required="" minlength="11" maxlength="13" value="{{ old('telepon_penyewa', $pemesanan->telepon_penyewa) }}">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="jaminan_penyewa-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Jaminan Penyewa</label>
                        <select id="jaminan_penyewa-{{ $pemesanan->id }}" name="jaminan_penyewa"
                            class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder:text-gray-400">
                            <option disabled selected="">- Pilih Jaminan -</option>
                            <option value="ktp" @selected(old('jaminan_penyewa', $pemesanan->jaminan_penyewa) == "ktp")>KTP</option>
                            <option value="stnk" @selected(old('jaminan_penyewa', $pemesanan->jaminan_penyewa) == "stnk")>STNK</option>
                            <option value="bpkb" @selected(old('jaminan_penyewa', $pemesanan->jaminan_penyewa) == "bpkb")>BPKB</option>
                            <option value="sim" @selected(old('jaminan_penyewa', $pemesanan->jaminan_penyewa) == "sim")>SIM</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full group">
                                <label for="tgl_mulai-{{ $pemesanan->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Tanggal Mulai <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input
                                        type="text"
                                        id="tgl_mulai-{{ $pemesanan->id }}"
                                        name="tgl_mulai"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-12 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Pilih Tanggal Mulai"
                                        required value="{{ old('tgl_mulai', $pemesanan->tgl_mulai) }}"
                                    >
                                </div>
                                @error('tgl_mulai')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="durasi_rental-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Durasi Rental</label>
                                <select id="durasi_rental-{{ $pemesanan->id }}" name="durasi_rental"
                                    class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder:text-gray-400">
                                    <option disabled selected="">- Pilih Durasi -</option>
                                    <option value="3" @selected(old('durasi_rental', $pemesanan->durasi_rental) == 3)>3 hari</option>
                                    <option value="5" @selected(old('durasi_rental', $pemesanan->durasi_rental) == 5)>5 hari</option>
                                    <option value="7" @selected(old('durasi_rental', $pemesanan->durasi_rental) == 7)>7 hari</option>
                                    <option value="14" @selected(old('durasi_rental', $pemesanan->durasi_rental) == 14)>14 hari</option>
                                </select>
                            </div>
                                <input type="hidden" id="tgl_selesai_hidden-{{ $pemesanan->id }}" name="tgl_selesai" value="{{ old('tgl_selesai', $pemesanan->tgl_selesai) }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-span-2 sm:col-span-1 hidden">
                        <label class="block mb-2.5 text-sm font-medium text-gray-300">Harga / hari (Rp)</label>

                        <p class="text-white text-md font-semibold p-2.5 bg-gray-700 border border-gray-600 rounded-lg">
                            Rp <span id="harga_per_hari_span">0</span>
                        </p>

                        <input type="hidden" id="harga_rental_per_hari_hidden-{{ $pemesanan->id }}" name="harga_rental_per_hari" value="0">
                    </div>

                    <div class="col-span-2 mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-300">Total Harga Rental</label>
                        <p class="text-white text-lg font-bold">
                            Rp <span id="total_harga_span-{{ $pemesanan->id }}">{{ old('total_biaya', $pemesanan->total_biaya) }}</span>
                        </p>
                        <input type="hidden" name="total_biaya" id="total_biaya-{{ $pemesanan->id }}" value="{{ old('total_biaya', $pemesanan->total_biaya) }}">
                    </div>

                    <div class="col-span-2 sm:col-span-1 mb-3">
                        <label for="status_pemesanan-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Status Pemesanan</label>
                        <select id="status_pemesanan-{{ $pemesanan->id }}" name="status_pemesanan"
                            class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder:text-gray-400">
                            <option value="dipesan" @selected(old('status_pemesanan', $pemesanan->status_pemesanan) == "dipesan")>Dipesan</option>
                            <option value="dirental" @selected(old('status_pemesanan', $pemesanan->status_pemesanan) == "dirental")>Dirental</option>
                            <option value="selesai" @selected(old('status_pemesanan', $pemesanan->status_pemesanan) == "selesai")>Selesai</option>
                            <option value="dibatalkan" @selected(old('status_pemesanan', $pemesanan->status_pemesanan) == "dibatalkan")>Dibatalkan</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="foto_ktp_sim-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Foto SIM / KTP (salah satu)</label>
                        <input class="block w-full text-sm text-gray-200 bg-gray-700 border border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 file:bg-indigo-600 file:text-white" aria-describedby="file_input_help" id="file_input-{{ $pemesanan->id }}" type="file" name="foto_ktp_sim">
                        <p class="mt-1 text-sm text-gray-400" id="file_input_help">PNG, JPG or JPEG (MAX. 2MB).</p>

                        @if ($pemesanan->foto_ktp_sim)
                            <p class="mt-2 text-xs text-gray-400">Gambar saat ini ada. Unggah file baru untuk mengganti.</p>

                            <div id="dropzone-area" class="mt-2 flex flex-col items-center justify-center w-full h-36 bg-gray-700 border-2 border-dashed border-gray-600 rounded-lg">

                                <img id="image-preview-{{ $pemesanan->id }}"
                                    src="{{ asset('storage/pemesanan/' . old('foto_ktp_sim', $pemesanan->foto_ktp_sim)) }}"
                                    alt="Preview KTP/SIM"
                                    class="w-full h-full object-cover rounded-lg p-2" />

                                <div id="default-content-{{ $pemesanan->id }}" class="hidden">
                                    </div>

                            </div>
                        @else
                            <div id="dropzone-area" class="mt-2 flex flex-col items-center justify-center w-full h-36 bg-gray-700 border-2 border-dashed border-gray-600 rounded-lg">
                                <img id="image-preview-{{ $pemesanan->id }}" src="#" alt="Preview KTP/SIM" class="hidden w-full h-full object-cover rounded-lg p-2" />
                                <div id="default-content-{{ $pemesanan->id }}" class="flex flex-col items-center justify-center text-white pt-5 pb-6">
                                    </div>
                            </div>
                        @endif
                    </div>

                <div class="flex items-center space-x-4 border-t border-gray-700 pt-4 md:pt-6">
                    <x-primary-button>
                        {{ __('Simpan') }}
                    </x-primary-button>

                    <button data-modal-hide="create-modal" type="button"
                        class="text-gray-300 bg-gray-700 border border-gray-600 hover:bg-gray-600 hover:text-white focus:ring-4 focus:ring-gray-500 font-medium leading-5 rounded-lg text-sm px-4 py-2.5 focus:outline-none">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <script>
    initModalEdit('{{ $pemesanan->id }}');

</script> --}}
