<!-- Modal Create Prestasi -->
<div id="createModal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full backdrop-blur-sm bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-2xl">
        <div class="relative bg-white rounded-lg shadow-sm">
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Tambah Prestasi
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" onclick="closeModal()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Tutup modal</span>
                </button>
            </div>
            <form id="createForm" class="p-4 md:p-5" method="POST" action="{{ route('admin.prestasi.store') }}">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div>
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Guru/Siswa/Tim</label>
                        <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="kelas_jabatan" class="block mb-2 text-sm font-medium text-gray-900">Kelas/Jabatan</label>
                        <input type="text" name="kelas_jabatan" id="kelas_jabatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="kejuaraan" class="block mb-2 text-sm font-medium text-gray-900">Kejuaraan</label>
                        <input type="text" name="kejuaraan" id="kejuaraan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="bidang" class="block mb-2 text-sm font-medium text-gray-900">Bidang</label>
                        <input type="text" name="bidang" id="bidang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="tingkat" class="block mb-2 text-sm font-medium text-gray-900">Tingkat</label>
                        <input type="text" name="tingkat" id="tingkat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required></textarea>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="bg-red-900 hover:bg-red-500 text-white px-4 py-2 rounded mr-2">Batal</button>
                    <button type="submit" class="bg-tertiary hover:bg-secondary text-white hover:text-tertiary px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
