<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">
                <h1 class="font-bold text-[32px] pt-7 pb-7 ">Daftar Prestasi</h1>
                <div class="flex justify-end mb-4">
                    <button onclick="openCreateModal()"
                        class="bg-tertiary text-white px-4 py-2 hover:bg-secondary hover:text-tertiary rounded">
                        Tambah Prestasi
                    </button>
                </div>
                <table
                    class="table-auto overflow-x-auto mx-auto items-center relative shadow-md sm:rounded-lg my-6 w-full max-w-full text-sm text-left text-gray-500">
                    <thead class="text-lg text-left text-gray-500 bg-gray-50">
                        <tr class="text-sm text-tertiary uppercase">
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Nama Guru/Siswa/Tim</th>
                            <th scope="col" class="px-6 py-3">Kelas/Jabatan</th>
                            <th scope="col" class="px-6 py-3">Kejuaraan</th>
                            <th scope="col" class="px-6 py-3">Bidang</th>
                            <th scope="col" class="px-6 py-3">Tingkat</th>
                            <th scope="col" class="px-6 py-3">Keterangan</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prestasi as $index => $prestasi)
                            <tr class="hover:bg-gray-200 transition duration-200 cursor-pointer">
                                <td class="px-6 py-2">{{ $index + 1 }}</td>
                                <td class="px-6 py-2">{{ $prestasi->nama }}</td>
                                <td class="px-6 py-2">{{ $prestasi->kelas_jabatan }}</td>
                                <td class="px-6 py-2">{{ $prestasi->kejuaraan }}</td>
                                <td class="px-6 py-2">{{ $prestasi->bidang }}</td>
                                <td class="px-6 py-2">{{ $prestasi->tingkat }}</td>
                                <td class="px-6 py-2">{{ $prestasi->keterangan }}</td>
                                <td class="px-6 py-2 text-center">
                                    <button onclick="openEditModal({{ $prestasi }})"
                                        class="bg-tertiary hover:bg-secondary text-white hover:text-tertiary px-4 py-2 rounded">Ubah</button>
                                    <button onclick="showDeletePrestasiModal({{ $prestasi->id }})"
                                        class="bg-red-900 text-white px-4 py-2 hover:bg-red-500 rounded ml-2">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.prestasi.create')
    @include('admin.prestasi.edit')
    @include('components.confirm-delete-modal', [
        'modalId' => 'deletePrestasiModal',
        'formAction' => route('admin.prestasi.destroy', ['prestasi' => '__ID__']),
        'message' => 'Yakin ingin menghapus data prestasi ini?'
    ])

    <script>
        function openCreateModal() {
            const createModal = document.getElementById('createModal');
            const createForm = document.getElementById('createForm');
            createForm.reset();
            createModal.classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('createModal').classList.add('hidden');
        }

        function openEditModal(achievement) {
            const editModal = document.getElementById('editModal');
            const editForm = document.getElementById('editForm');
            const nama = document.getElementById('editNama');
            const kelasJabatan = document.getElementById('editKelasjabatan');
            const kejuaraan = document.getElementById('editKejuaraan');
            const bidang = document.getElementById('editBidang');
            const tingkat = document.getElementById('editTingkat');
            const keterangan = document.getElementById('editKeterangan');

            nama.value = achievement.nama;
            kelasJabatan.value = achievement.kelas_jabatan;
            kejuaraan.value = achievement.kejuaraan;
            bidang.value = achievement.bidang;
            tingkat.value = achievement.tingkat;
            keterangan.value = achievement.keterangan;

            editForm.action = `/admin/prestasi/${achievement.id}`;
            editModal.classList.remove('hidden');
        }

        function showDeletePrestasiModal(id) {
            const modal = document.getElementById('deletePrestasiModal');
            if (modal) {
                const form = modal.querySelector('form');
                if (form) {
                    form.action = `/admin/prestasi/${id}`;
                }
                modal.classList.remove('hidden');
            }
        }
    </script>
</x-app-layout>