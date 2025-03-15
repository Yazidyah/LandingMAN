<form action="{{ route('kuesioner.store', ['respondent_id' => $respondent_id]) }}" method="POST" class="space-y-8 flex flex-col items-center">
    @csrf
    <input type="hidden" name="respondent_id" value="{{ $respondent_id }}">
    @foreach ($questions as $question)
        <div class="p-6 bg-white rounded-lg shadow w-full max-w-2xl">
            <p class="mb-6 text-xl font-semibold text-gray-800">
                {{ $question->question_text }}
            </p>
            <div class="flex flex-wrap items-center gap-6 justify-center">
                @foreach (['1' => 'Sangat tidak puas', '2' => 'Tidak puas', '3' => 'Netral', '4' => 'Setuju', '5' => 'Sangat setuju'] as $value => $description)
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="question_{{ $question->question_id }}" value="{{ $value }}"
                            class="form-radio h-6 w-6 text-blue-600 border-gray-300 focus:ring-blue-500">
                        <span class="ml-3 text-gray-700">
                            {{ $description }}
                        </span>
                    </label>
                @endforeach
            </div>
        </div>
    @endforeach
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
</form>