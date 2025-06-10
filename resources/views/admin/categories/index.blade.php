<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">
                <h1 class="font-bold text-[32px] pt-7 pb-7 ">Konfigurasi Kategori Konten</h1>
                <div class="flex justify-end">
                    <button onclick="openCreateModal()"
                        class="bg-tertiary hover:bg-secondary text-white hover:text-tertiary px-4 py-2 rounded">
                        Buat Kategori
                    </button>
                </div>
                <table
                    class="table-auto overflow-x-auto mx-auto items-center relative shadow-md sm:rounded-lg my-6 w-full max-w-full rtl:justify-left text-sm text-left text-gray-500">
                    <thead class="w-full max-w-full rtl:justify-left text-lg text-left text-gray-500 my-3">
                        <tr class="text-sm text-tertiary uppercase bg-gray-50">
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Nama Kategori</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index => $category)
                            <tr class="hover:bg-gray-200 transition duration-200 cursor-pointer">
                                <td class="px-6 py-4 text-tertiary">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-tertiary">{{ strtoupper($category->category_name) }}</td>
                                <td class="px-6 py-4 text-tertiary">
                                    <button onclick="openEditModal({{ $category->id }})"
                                        class="bg-tertiary hover:bg-secondary text-white hover:text-tertiary px-4 py-2 rounded">Edit</button>
                                    <button type="button" onclick="document.getElementById('deleteCategoryModal-{{ $category->id }}').classList.remove('hidden')"
                                        class="bg-red-900 text-white px-4 py-2 hover:bg-red-500 rounded">Delete</button>
                                    <x-confirm-delete-modal 
                                        :modalId="'deleteCategoryModal-' . $category->id"
                                        :formAction="route('admin.categories.destroy', $category->id)"
                                        title="Konfirmasi Hapus Kategori"
                                        message="Apakah Anda yakin ingin menghapus kategori ini?"
                                    />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="editModalContainer"></div>
        <div id="createModalContainer">
            @include('admin.categories.create')
        </div>
        <script>
            function openEditModal(id) {
                fetch(`/admin/categories/${id}/edit`)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('editModalContainer').innerHTML = html;
                        document.getElementById('editModal').classList.remove('hidden');
                    });
            }

            function openCreateModal() {
                document.getElementById('createModal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('editModal').classList.add('hidden');
            }

            function closeCreateModal() {
                document.getElementById('createModal').classList.add('hidden');
            }
        </script>
</x-app-layout>