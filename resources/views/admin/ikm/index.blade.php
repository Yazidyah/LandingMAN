<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">
                <h1 class="font-bold text-[32px] pt-7 pb-7 ">Indeks Kepuasan Masyarakat</h1>
                
                <!-- Filter Dropdown -->
                <form method="GET" action="{{ route('admin.ikm.index') }}" class="mb-6">
                    <select name="survey_id" class="border border-gray-300 rounded p-2">
                        <option value="">-- Pilih Survey --</option>
                        @foreach ($allSurveys as $survey)
                            <option value="{{ $survey->id }}" {{ request('survey_id') == $survey->id ? 'selected' : '' }}>
                                {{ $survey->survey_name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
                </form>

                <!-- Table to display questions -->
                <table
                    class="table-auto overflow-x-auto mx-auto items-center relative shadow-md sm:rounded-lg my-6 w-full max-w-full rtl:justify-left text-sm text-left text-gray-500">
                    <thead class="w-full max-w-full rtl:justify-left text-lg text-left text-gray-500 my-3">
                        <tr class="text-sm text-tertiary uppercase bg-gray-50 text-center">
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Pertanyaan</th>
                            <th scope="col" class="px-6 py-3">Jumlah Nilai per Unsur</th>
                            <th scope="col" class="px-6 py-3">NRR per Unsur</th>
                            <th scope="col" class="px-6 py-3">Bobot Nilai Tetimbang</th>
                            <th scope="col" class="px-6 py-3">NRR Tetimbang per Unsur</th>
                        </tr>
                    </thead>
                    <tbody class="text-left">
                        @foreach ($surveys as $survey)
                            @foreach ($survey->questions as $question)
                                <tr>
                                    <td class="px-6 py-3 text-center">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-3 text-center">{{ $question->question_text }}</td>
                                    <td class="px-6 py-3 text-center">{{ $jumlahNilaiUnsur[$question->id] ?? 0 }}</td>
                                    <td class="px-6 py-3 text-center">{{ number_format($nrrUnsur[$question->id] ?? 0, 2) }}</td>
                                    <td class="px-6 py-3 text-center">{{ number_format($bobotNilaiTetimbang, 3) }}</td>
                                    <td class="px-6 py-3 text-center">{{ number_format($tetimbangPerUnsur[$question->id] ?? 0, 3) }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6">
                    <h3 class="text-[20px]">IKM: {{ number_format($ikm, 1) }}%</h3>
                    <h3 class="text-[20px]">Bobot Nilai Tetimbang: {{ number_format($bobotNilaiTetimbang, 3) }}</h3>
                    <h3 class="text-[20px]">Kinerja Unit Pelayanan: {{ $rating }}</h3>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



