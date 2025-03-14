<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto pt-5 px-4">
                <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
                    <h2 class="font-bold text-3xl md:text-4xl">Survey List</h2>
                </div>
                <button onclick="openCreateModal()"
                    class="bg-tertiary text-white px-4 py-2 hover:bg-secondary hover:text-tertiary rounded">
                    Buat Survey
                </button>
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="text-center">
                            <th class="py-2">ID</th>
                            <th class="py-2">Name</th>
                            <th class="py-2">Description</th>
                            <th class="py-2">Start Date</th>
                            <th class="py-2">End Date</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($surveys as $survey)
                            <tr>
                                <td class="py-2">{{ $survey->survey_id }}</td>
                                <td class="py-2">{{ $survey->survey_name }}</td>
                                <td class="py-2">{{ $survey->description }}</td>
                                <td class="py-2">{{ $survey->start_date }}</td>
                                <td class="py-2">{{ $survey->end_date }}</td>
                                <td class="py-2">
                                <button onclick="openEditModal({{ $survey->survey_id }})" class="bg-tertiary hover:bg-secondary text-white hover:text-tertiary px-4 py-2 rounded">Edit</button>
                                <form action="{{ route('admin.survey.destroy', $survey->survey_id) }}" method="POST" class="inline">
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

@include('admin.survey.create')
@include('admin.survey.edit')

<script>
    function openCreateModal() {
        const createForm = document.getElementById('createForm');
        createForm.reset(); // Reset the form fields
        document.getElementById('createModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('createModal').classList.add('hidden');
    }

    function openEditModal(survey) {
        const editModal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');
        const surveyName = document.getElementById('surveyName');
        const description = document.getElementById('description');
        const startDate = document.getElementById('startDate');
        const endDate = document.getElementById('endDate');

        surveyName.value = survey.survey_name;
        description.value = survey.description;
        startDate.value = survey.start_date;
        endDate.value = survey.end_date;
        editForm.action = `/admin/survey/${survey.survey_id}`;

        editModal.classList.remove('hidden');
    }
</script>