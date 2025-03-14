<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto pt-5 px-4">
                <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
                    <h2 class="font-bold text-3xl md:text-4xl">Kuesioner List</h2>
                </div>
                <button onclick="openCreateModal()"
                    class="bg-tertiary text-white px-4 py-2 hover:bg-secondary hover:text-tertiary rounded">
                    Buat Kuesioner
                </button>
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="text-center">
                            <th class="py-2">ID</th>
                            <th class="py-2">Jenis Survey</th>
                            <th class="py-2">Pertanyaan</th>
                            <th class="py-2">Urutan Pertanyaan</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($kuesioners as $kuesioner)
                            <tr>
                                <td class="py-2">{{ $kuesioner->question_id }}</td>
                                <td class="py-2">{{ $kuesioner->survey_id }}</td>
                                <td class="py-2">{{ $kuesioner->question_text }}</td>
                                <td class="py-2">{{ $kuesioner->question_order }}</td>
                                <td class="py-2">
                                <button onclick="openEditModal({{ $kuesioner }})" class="bg-tertiary hover:bg-secondary text-white hover:text-tertiary px-4 py-2 rounded">Edit</button>
                                <form action="{{ route('admin.kuesioner.destroy', $kuesioner->question_id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-900 text-white px-4 py-2 hover:bg-red-500 rounded" >Delete</button>
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