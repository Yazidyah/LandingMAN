@if(auth()->user()->name !== 'superadmin')
    <script>window.location.href = "{{ route('admin.dashboard') }}";</script>
    @php exit; @endphp
@endif

<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">
                <h1 class="font-bold text-[32px] pt-7 pb-7 ">Konfigurasi Admin</h1>
                <div class="flex justify-end">
                    <button onclick="openCreateModal()"
                        class="bg-tertiary text-white px-4 py-2 hover:text-tertiary hover:bg-secondary rounded">
                        Tambah User
                    </button>
                </div>
                <table
                    class="table-auto overflow-x-auto mx-auto items-center relative shadow-md sm:rounded-lg my-6 w-full max-w-full rtl:justify-left text-sm text-left text-gray-500">
                    <thead class="w-full max-w-full rtl:justify-left text-lg text-left text-gray-500 my-3">
                        <tr class="text-sm text-tertiary uppercase bg-gray-50">
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <button onclick="openEditModal({{ json_encode($user) }})"
                                        class="bg-tertiary hover:bg-secondary text-white hover:text-tertiary px-4 py-2 rounded">Ubah</button>
                                        <button onclick="showDeleteUsersModal({{ $user->id }})"
                                        class="bg-red-900 text-white px-4 py-2 hover:bg-red-500 rounded ml-2">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

@include('admin.users.create')
@include('admin.users.edit')
@include('components.confirm-delete-modal', [
    'modalId' => 'deleteUsersModal',
    'formAction' => route('admin.users.destroy', ['user' => '__ID__']),
    'message' => 'Yakin ingin menghapus pengguna ini?'
])
<script>
    function openCreateModal() {
        const createModal = document.getElementById('createModal');
        const createForm = document.getElementById('createForm');
        if (createForm) {
            createForm.reset();
        }
        createModal.classList.remove('hidden');
    }

    function closeCreateModal() {
        const createModal = document.getElementById('createModal');
        if (createModal) {
            createModal.classList.add('hidden');
        }
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('createModal').classList.add('hidden');
    }

    function closeEditModal() {
        const editModal = document.getElementById('editModal');
        // If the currently focused element is inside the modal, blur it first
        if (editModal.contains(document.activeElement)) {
            document.activeElement.blur();
        }
        editModal.classList.add('hidden');
    }

    function openEditModal(user) {
        const editModal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');
        const name = document.getElementById('editName');
        const password = document.getElementById('editPassword');

        name.value = user.name;
        password.value = ""; // Always blank for security
        editForm.action = `/admin/users/${user.id}`;

        editModal.classList.remove('hidden');
    }

    function showDeleteUsersModal(id) {
        const modal = document.getElementById('deleteUsersModal');
        if (modal) {
            const form = modal.querySelector('form');
            if (form) {
                form.action = `/admin/users/${id}`;
            }
            modal.classList.remove('hidden');
        }
    }
</script>
