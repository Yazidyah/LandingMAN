<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">
                <h1 class="font-bold text-[32px] pt-7 pb-7 ">Pengaturan FAQ</h1>
                <div class="flex justify-end">
                    <button onclick="openCreateModal()"
                        class="bg-tertiary text-white px-4 py-2 hover:text-tertiary hover:bg-secondary rounded">
                        Tambah FAQ
                    </button>
                </div>
                <table
                    class="table-auto overflow-x-auto mx-auto items-center relative shadow-md sm:rounded-lg my-6 w-full max-w-full rtl:justify-left text-sm text-left text-gray-500">
                    <thead class="w-full max-w-full rtl:justify-left text-lg text-left text-gray-500 my-3">
                        <tr class="text-sm text-tertiary uppercase bg-gray-50">
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Question</th>
                            <th scope="col" class="px-6 py-3">Answer</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faqs as $index => $faq)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $faq->question }}</td>
                                <td class="px-6 py-4">{{ $faq->answer }}</td>
                                <td class="px-6 py-4">
                                    <button onclick="openEditModal({{ $faq->id }})"
                                        class="bg-tertiary hover:bg-secondary text-white hover:text-tertiary px-4 py-2 rounded">Edit</button>
                                    <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-900 text-white px-4 py-2 hover:bg-red-500 rounded">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="createModalContainer">
        @include('admin.faq.create')
    </div>
    <div id="editModalContainer"></div>
    <script>
        function openCreateModal() {
            const createModal = document.getElementById('createModal');
            if (createModal) {
                createModal.classList.remove('hidden');
            }
        }

        function closeCreateModal() {
            const createModal = document.getElementById('createModal');
            if (createModal) {
                createModal.classList.add('hidden');
            }
        }

        function openEditModal(id) {
            fetch(`/admin/faq/${id}/edit`)
                .then(response => response.text())
                .then(html => {
                    const editModalContainer = document.getElementById('editModalContainer');
                    if (editModalContainer) {
                        editModalContainer.innerHTML = html;
                        const editModal = document.getElementById('EditModal');
                        if (editModal) {
                            editModal.classList.remove('hidden');
                        }
                    }
                });
        }

        function closeEditModal() {
            const editModal = document.getElementById('EditModal');
            if (editModal) {
                editModal.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>