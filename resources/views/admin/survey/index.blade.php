<x-app-layout>
<div class="p-4 sm:ml-64">
<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">

<div class="container mx-auto pt-5 px-4">
    <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
        <h2 class="font-bold text-3xl md:text-4xl">Survey List</h2>
    </div>    <div class="mb-4">
        <a href="{{ route('admin.survey.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Survey</a>
    </div>
    <table class="min-w-full bg-white">
        <thead>
            <tr></tr></tr>
                <th class="py-2">ID</th>
                <th class="py-2">Name</th>
                <th class="py-2">Description</th>
                <th class="py-2">Start Date</th>
                <th class="py-2">End Date</th>
                <th class="py-2">Actions</th>
            </tr>
        </thead>
        <tbody></tbody></tbody>
            @foreach ($surveys as $survey)
                <tr>
                    <td class="py-2">{{ $survey->survey_id }}</td>
                    <td class="py-2">{{ $survey->survey_name }}</td>
                    <td class="py-2">{{ $survey->description }}</td>
                    <td class="py-2">{{ $survey->start_date }}</td>
                    <td class="py-2">{{ $survey->end_date }}</td>
                    <td class="py-2"></td>
                        <a href="{{ route('admin.survey.edit', $survey->survey_id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                        <form action="{{ route('admin.survey.destroy', $survey->survey_id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</x-app-layout>



