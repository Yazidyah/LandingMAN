<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">
                <h1 class="font-bold text-[32px] pt-7 pb-7 ">Konfigurasi Unsur</h1>
                <div class="flex justify-end">
                    <button onclick="openCreateModal()"
                        class="bg-tertiary text-white px-4 py-2 hover:bg-secondary hover:text-tertiary rounded">
                        Buat Unsur
                    </button>
                </div>
                <table
                    class="table-auto overflow-x-auto mx-auto items-center relative shadow-md sm:rounded-lg my-6 w-full max-w-full rtl:justify-left text-sm text-left text-gray-500">
                    <thead class="w-full max-w-full rtl:justify-left text-lg text-left text-gray-500 my-3">
                        <tr class="text-sm text-tertiary uppercase bg-gray-50 text-center">
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Unsur Name</th>
                            <th scope="col" class="px-6 py-3">Description</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($unsurs as $unsur)
                            <tr class="hover:bg-gray-200 transition duration-200 cursor-pointer">
                                <td class="py-2">{{ $unsur->id }}</td>
                                <td class="py-2">{{ $unsur->unsur_name }}</td>
                                <td class="py-2">{{ $unsur->description }}</td>
                                <td class="py-2">
                                    <button onclick="openEditModal({{ $unsur }})"
                                        class="bg-tertiary hover:bg-secondary text-white hover:text-tertiary px-4 py-2 rounded">Edit</button>
                                    <button onclick="showDeleteUnsurModal({{ $unsur->id }})"
                                        class="bg-red-900 text-white px-4 py-2 hover:bg-red-500 rounded ml-2">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

@include('admin.unsur.create')
@include('admin.unsur.edit')
@include('components.confirm-delete-modal', [
    'modalId' => 'deleteUnsurModal',
    'formAction' => route('admin.unsur.destroy', ['unsur' => '__ID__']),
    'message' => 'Yakin ingin menghapus unsur ini?'
])

<script>
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('createModal').classList.add('hidden');
    }

    function openEditModal(unsur) {
        const editModal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');
        const elementName = document.getElementById('editElementName');
        const description = document.getElementById('editDescription');

        elementName.value = unsur.unsur_name;
        description.value = unsur.description;
        editForm.action = `/admin/unsur/${unsur.id}`;

        editModal.classList.remove('hidden');
    }

    function showDeleteUnsurModal(id) {
        const modal = document.getElementById('deleteUnsurModal');
        if (modal) {
            const form = modal.querySelector('form');
            if (form) {
                form.action = `/admin/unsur/${id}`;
            }
            modal.classList.remove('hidden');
        }
    }
</script>