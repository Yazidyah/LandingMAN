<!-- Main modal for Create -->
<div id="createModal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full backdrop-blur-sm bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-2xl"> <!-- Adjusted max-width to match edit.blade.php -->
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Create Kuesioner
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" onclick="closeModal()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Tutup modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="createForm" class="p-4 md:p-5" method="POST" action="{{ route('admin.kuesioner.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div class="col-span-1">
                        <label for="surveyId" class="block mb-2 text-sm font-medium text-gray-900">Survey</label>
                        <select name="survey_id" id="surveyId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            <option value="" disabled selected>Pilih Survey</option>
                            @foreach($surveys as $survey)
                                <option value="{{ $survey->id }}">{{ $survey->survey_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-1">
                        <label for="unsurId" class="block mb-2 text-sm font-medium text-gray-900">Unsur</label>
                        <select name="unsur_id" id="unsurId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            <option value="" disabled selected>Pilih Unsur</option>
                            @foreach($unsurs as $unsur) <!-- Updated variable name -->
                                <option value="{{ $unsur->id }}">{{ $unsur->unsur_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-1">
                        <label for="questionText" class="block mb-2 text-sm font-medium text-gray-900">Pertanyaan</label>
                        <textarea name="question_text" id="questionText" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required></textarea>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="bg-red-900 hover:bg-red-500 text-white px-4 py-2 rounded mr-2">Batal</button>
                    <button type="submit" class="bg-tertiary hover:bg-secondary text-white hover:text-tertiary px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
