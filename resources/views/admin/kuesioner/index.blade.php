<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">
                <h1 class="font-bold text-[32px] pt-7 pb-7 ">Konfigurasi Kuesioner</h1>
                <div class="flex justify-end">
                    <button onclick="openCreateModal()"
                        class="bg-tertiary text-white px-4 py-2 hover:bg-secondary hover:text-tertiary rounded">
                        Buat Pertanyaan
                    </button>
                </div>
                <table
                    class="table-auto overflow-x-auto mx-auto items-center relative shadow-md sm:rounded-lg my-6 w-full max-w-full rtl:justify-left text-sm text-left text-gray-500">
                    <thead class="w-full max-w-full rtl:justify-left text-lg text-left text-gray-500 my-3">
                        <tr class="text-sm text-tertiary uppercase bg-gray-50 text-center">
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Jenis Survey</th>
                            <th scope="col" class="px-6 py-3">Pertanyaan</th>
                            <th scope="col" class="px-6 py-3">Urutan Pertanyaan</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($kuesioners as $kuesioner)
                        <tr class="hover:bg-gray-200 transition duration-200 cursor-pointer">
                                <td class="py-2">{{ $kuesioner->question_id }}</td>
                                <td class="py-2">{{ $kuesioner->survey_id }}</td>
                                <td class="py-2">{{ $kuesioner->question_text }}</td>
                                <td class="py-2">{{ $kuesioner->question_order }}</td>
                                <td class="py-2">
                                    <button onclick="openEditModal({{ $kuesioner }})"
                                        class="bg-tertiary hover:bg-secondary text-white hover:text-tertiary px-4 py-2 rounded">Edit</button>
                                    <form action="{{ route('admin.kuesioner.destroy', $kuesioner->question_id) }}"
                                        method="POST" class="inline">
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
</x-app-layout>

@include('admin.kuesioner.create')
@include('admin.kuesioner.edit')

<script>
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('createModal').classList.add('hidden');
    }

    function openEditModal(kuesioner) {
        const editModal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');
        const surveyId = document.getElementById('surveyId');
        const questionText = document.getElementById('questionText');
        const questionOrder = document.getElementById('questionOrder');

        surveyId.value = kuesioner.survey_id;
        questionText.value = kuesioner.question_text;
        questionOrder.value = kuesioner.question_order;
        editForm.action = `/admin/kuesioner/${kuesioner.question_id}`;

        editModal.classList.remove('hidden');
    }
</script>