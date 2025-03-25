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
                    <button type="submit" class="mt-4 px-4 py-2 inline-flex justify-center items-center  bg-tertiary border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-tertiary active:bg-tertiary active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2  transition ease-in-out duration-150 roundedz">Filter</button>
                </form>

                <table
                    class="table-auto overflow-x-auto mx-auto items-center relative shadow-md sm:rounded-lg my-6 w-full max-w-full rtl:justify-left text-sm text-left text-gray-500">
                    <thead class="w-full max-w-full rtl:justify-left text-lg text-left text-gray-500 my-3">
                        <tr class="text-xs text-tertiary uppercase bg-gray-50 text-center">
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
                                    <td class="px-6 py-3">{{ $question->question_text }}</td>
                                    <td class="px-6 py-3 text-center">{{ isset($data[$question->id]['jumlahNilaiUnsur']) ? number_format($data[$question->id]['jumlahNilaiUnsur'], 2) : '-' }}</td>
                                    <td class="px-6 py-3 text-center">{{ isset($data[$question->id]['nrr']) ? number_format($data[$question->id]['nrr'], 2) : '-' }}</td>
                                    <td class="px-6 py-3 text-center">{{ isset($data[$question->id]['bobotNilaiTertimbang']) ? number_format($data[$question->id]['bobotNilaiTertimbang'], 2) : '-' }}</td>
                                    <td class="px-6 py-3 text-center">{{ isset($data[$question->id]['nrrTetimbang']) ? number_format($data[$question->id]['nrrTetimbang'], 2) : '-' }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

                <!-- Display IKM -->
                <div class="mt-6">
                    <h2 class="font-bold text-[24px]">Indeks Kepuasan Masyarakat (IKM): {{ number_format($ikm, 2) }}</h2>
                    <h3 class="text-[20px]">Persentase IKM: {{ number_format($ikmPercentage, 2) }}%</h3>
                    <h3 class="text-[20px]">Kategori Kepuasan: {{ $satisfactionLabel }}</h3>
                    <h3 class="text-[20px]">Nilai Tertimbang: {{ number_format($nilaiTertimbang, 2) }}</h3>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



