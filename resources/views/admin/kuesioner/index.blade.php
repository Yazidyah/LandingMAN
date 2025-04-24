<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">
                <h1 class="font-bold text-[32px] pt-7 pb-7 ">Konfigurasi Kuesioner</h1>
                <div class="flex justify-between items-center">
                    <form method="GET" action="{{ route('admin.kuesioner.index') }}" class="flex items-center">
                        <label for="surveyFilter" class="mr-2">Filter by Survey:</label>
                        <select name="survey_id" id="surveyFilter" class="border rounded px-2 py-1">
                            <option value="">All</option>
                            @foreach ($surveys as $survey)
                                <option value="{{ $survey->id }}" {{ request('survey_id') == $survey->id ? 'selected' : '' }}>
                                    {{ $survey->survey_name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="ml-2 bg-tertiary text-white px-4 py-2 rounded hover:bg-secondary hover:text-tertiary">
                            Filter
                        </button>
                    </form>
                    <button onclick="openCreateModal()"
                        class="bg-tertiary text-white px-4 py-2 hover:bg-secondary hover:text-tertiary rounded">
                        Buat Pertanyaan
                    </button>
                </div>
                <table
                    class="table-auto overflow-x-auto mx-auto items-center relative shadow-md sm:rounded-lg my-6 w-full max-w-full rtl:justify-left text-sm text-left text-gray-500">
                    <thead class="w-full max-w-full rtl:justify-left text-lg text-left text-gray-500 my-3">
                        <tr class="text-sm text-tertiary uppercase bg-gray-50">
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Survey</th>
                            <th scope="col" class="px-6 py-3">Unsur</th>
                            <th scope="col" class="px-6 py-3">Pertanyaan</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kuesioners as $kuesioner)
                        <tr class="hover:bg-gray-200 transition duration-200 cursor-pointer">
                                <td class="px-6 py-2 w-24">{{ $kuesioner->id }}</td>
                                <td class="px-6 py-2 w-64">{{ $kuesioner->survey_name ?? 'N/A' }}</td>
                                <td class="px-6 py-2 w-64">{{ $kuesioner->unsur_name ?? 'N/A' }}</td>
                                <td class="px-6 py-2 w-2/5">{{ $kuesioner->question_text }}</td>
                                <td class="px-6 py-2 text-center">
                                    <button onclick="openEditModal({{ $kuesioner }})"
                                        class="bg-tertiary hover:bg-secondary text-white hover:text-tertiary px-4 py-2 rounded">Edit</button>
                                    <button onclick="showDeleteKuesionerModal({{ $kuesioner->id }})"
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

@include('admin.kuesioner.create')
@include('admin.kuesioner.edit')
@include('components.confirm-delete-modal', [
    'modalId' => 'deleteKuesionerModal',
    'formAction' => route('admin.kuesioner.destroy', ['kuesioner' => '__ID__']),
    'message' => 'Yakin ingin menghapus pertanyaan ini?'
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

    function openEditModal(kuesioner) {
        const editModal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');
        const questionText = document.getElementById('editQuestionText');
        const questionOrder = document.getElementById('editQuestionOrder');
        const elementId = document.getElementById('EditElementId'); 
        const surveyId = document.getElementById('EditSurveyId'); 

        questionText.value = kuesioner.question_text;
        questionOrder.value = kuesioner.question_order;
        elementId.value = kuesioner.unsur_id;
        surveyId.value = kuesioner.survey_id; 
        editForm.action = `/admin/kuesioner/${kuesioner.id}`;

        editModal.classList.remove('hidden');
    }

    function showDeleteKuesionerModal(id) {
        const modal = document.getElementById('deleteKuesionerModal');
        if (modal) {
            const form = modal.querySelector('form');
            if (form) {
                form.action = `/admin/kuesioner/${id}`;
            }
            modal.classList.remove('hidden');
        }
    }
</script>