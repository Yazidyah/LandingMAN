<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto pt-5 px-4">
                <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
                    <h2 class="font-bold text-3xl md:text-4xl">Hasil Pengaduan di MAN 1 Kota Bogor</h2>
                </div>
            </div>
            <div class="container mx-auto text-center pt-7">
                <h1 class="font-bold text-[32px] pt-7 pb-7">Daftar Kritik dan Saran</h1>
                <form method="GET" action="{{ route('admin.kritiksaran.index') }}" class="mb-6 flex items-center justify-center space-x-4">
                    <label for="survey_id" class="text-sm font-medium text-gray-700">Filter by Survey</label>
                    <select name="survey_id" id="survey_id" class="p-2 border border-gray-300 rounded-lg">
                        <option value="">All Surveys</option>
                        @foreach ($surveys as $survey)
                            <option value="{{ $survey->id }}" {{ $surveyId == $survey->id ? 'selected' : '' }}>
                                {{ $survey->survey_name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="ml-2 bg-tertiary text-white px-4 py-2 rounded hover:bg-secondary hover:text-tertiary">
                            Filter
                        </button>
                </form>
                @if ($feedbacks->isEmpty())
                    <p class="text-red-500 font-bold text-lg">DATA TIDAK DITEMUKAN</p>
                @else
                    <table class="table-auto overflow-x-auto mx-auto items-center relative shadow-md sm:rounded-lg my-6 w-full max-w-full text-sm text-left text-gray-500">
                        <thead class="w-full max-w-full text-lg text-left text-gray-500 my-3">
                            <tr class="text-sm text-tertiary uppercase bg-gray-50">
                                <th class="px-6 py-3 text-left">ID</th>
                                <th class="px-6 py-3 text-left">Nama Survey</th>
                                <th class="px-6 py-3 text-left">Nama Lengkap</th>
                                <th class="px-6 py-3 text-left w-1/4">Kritik</th>
                                <th class="px-6 py-4 text-left w-1/4">Saran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $feedback)
                                <tr class="hover:bg-gray-200 transition duration-200 cursor-pointer">
                                    <td class="px-6 py-2">{{ $feedback->id }}</td>
                                    <td class="px-6 py-2">{{ $feedback->survey->survey_name }}</td>
                                    <td class="px-6 py-2">{{ strtoupper($feedback->respondent->nama_lengkap) }}</td>
                                    <td class="px-6 py-2 w-1/4">{{ $feedback->kritik }}</td>
                                    <td class="px-6 py-2 w-1/4">{{ $feedback->saran }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>



