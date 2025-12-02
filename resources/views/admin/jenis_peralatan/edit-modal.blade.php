@props(['jenis_peralatan'])

<div id="edit-modal-{{ $jenis_peralatan->id_jenis_peralatan }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full">

    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-gray-800 border border-gray-700 rounded-lg shadow-2xl p-4 md:p-6">

            <div class="flex items-center justify-between border-b border-gray-700 pb-4 md:pb-5">
                <h3 class="text-xl font-medium text-white">
                    Edit Jenis Peralatan: {{ $jenis_peralatan->merek }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="edit-modal-{{ $jenis_peralatan->id_jenis_peralatan }}">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <form action="{{ route('jenis_peralatan.update', $jenis_peralatan->id_jenis_peralatan) }}" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 grid-cols-2 py-4 md:py-6">

                    <div class="col-span-2">
                        <label for="merek-{{ $jenis_peralatan->id_jenis_peralatan }}" class="block mb-2.5 text-sm font-medium text-gray-300">Merek</label>
                        <input type="text" name="merek" id="merek-{{ $jenis_peralatan->id_jenis_peralatan }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: FrlFrz" required="" value="{{ old('merek', $jenis_peralatan->merek) }}">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="kategori-{{ $jenis_peralatan->id_jenis_peralatan }}" class="block mb-2.5 text-sm font-medium text-gray-300">Kategori</label>
                        <select id="kategori-{{ $jenis_peralatan->id_jenis_peralatan }}" name="kategori"
                            class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder:text-gray-400">
                            <option disabled>- Pilih kategori -</option>
                            <option value="console" @selected(old('kategori', $jenis_peralatan->kategori) == 'console')>Console</option>
                            <option value="vr" @selected(old('kategori', $jenis_peralatan->kategori) == 'vr')>VR (Virtual Reality)</option>
                            <option value="display" @selected(old('kategori', $jenis_peralatan->kategori) == 'display')>Display</option>
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="harga_rental_per_hari-{{ $jenis_peralatan->id_jenis_peralatan }}" class="block mb-2.5 text-sm font-medium text-gray-300">Harga/Hari (Rp)</label>
                        <input type="number" name="harga_rental_per_hari" id="harga_rental_per_hari-{{ $jenis_peralatan->id_jenis_peralatan }}" minlength="4"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: 50000" required="" value="{{ round(old('harga_rental_per_hari', $jenis_peralatan->harga_rental_per_hari)) }}">
                    </div>

                    <div class="col-span-2">
                        <label for="deskripsi-{{ $jenis_peralatan->id_jenis_peralatan }}" class="block mb-2.5 text-sm font-medium text-gray-300">Deskripsi</label>
                        <input type="textarea" name="deskripsi" id="deskripsi-{{ $jenis_peralatan->id_jenis_peralatan }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Catatan tambahan..." value="{{ old('deskripsi', $jenis_peralatan->deskripsi) }}">
                    </div>

                    <div class="col-span-2">
                        <label for="foto_peralatan-{{ $jenis_peralatan->id_jenis_peralatan }}" class="block mb-2.5 text-sm font-medium text-gray-300">Foto peralatan (Opsional)</label>

                        <input type="file" name="foto_peralatan" id="foto_peralatan-{{ $jenis_peralatan->id_jenis_peralatan }}"
                            class="block w-full text-sm text-gray-200 bg-gray-700 border border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 file:bg-indigo-600 file:text-white"
                            accept="image/*" onchange="previewImageEdit(this)">

                        @if ($jenis_peralatan->foto_peralatan)
                            <p class="mt-2 text-xs text-gray-400">Gambar saat ini ada. Unggah file baru untuk mengganti.</p>

                            <div id="dropzone-area" class="mt-2 flex flex-col items-center justify-center w-full h-64 bg-gray-700 border-2 border-dashed border-gray-600 rounded-lg">

                                <img id="image-preview-{{ $jenis_peralatan->id_jenis_peralatan }}"
                                    src="{{ asset('storage/jenis_peralatan/' . old('foto_peralatan', $jenis_peralatan->foto_peralatan)) }}"
                                    alt="Preview peralatan"
                                    class="w-full h-full object-cover rounded-lg p-2" />

                                <div id="default-content-{{ $jenis_peralatan->id_jenis_peralatan }}" class="hidden">
                                    </div>

                            </div>
                        @else
                            <div id="dropzone-area" class="mt-2 flex flex-col items-center justify-center w-full h-64 bg-gray-700 border-2 border-dashed border-gray-600 rounded-lg">
                                <img id="image-preview-{{ $jenis_peralatan->id_jenis_peralatan }}" src="#" alt="Preview peralatan" class="hidden w-full h-full object-cover rounded-lg p-2" />
                                <div id="default-content-{{ $jenis_peralatan->id_jenis_peralatan }}" class="flex flex-col items-center justify-center text-white pt-5 pb-6">
                                    </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center space-x-4 border-t border-gray-700 pt-4 md:pt-6">
                    <x-primary-button>
                        {{ __('Simpan Perubahan') }}
                    </x-primary-button>
                    <button data-modal-hide="edit-modal-{{ $jenis_peralatan->id_jenis_peralatan }}" type="button"
                        class="text-white bg-gray-700 border border-gray-600 hover:bg-gray-600 hover:text-white focus:ring-4 focus:ring-gray-500 font-medium leading-5 rounded-lg text-sm px-4 py-2.5 focus:outline-none">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImageEdit(inputElement) {
        const elementId = inputElement.id;
        const userId = elementId.split('-').pop();

        const previewImage = document.getElementById(`image-preview-${userId}`);
        const defaultContent = document.getElementById(`default-content-${userId}`);

        if (inputElement.files && inputElement.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;

                previewImage.classList.remove('hidden');
                if (defaultContent) {
                    defaultContent.classList.add('hidden');
                }
            }

            reader.readAsDataURL(inputElement.files[0]);
        }
    }
</script>
