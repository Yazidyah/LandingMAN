<div class="space-y-8 flex flex-col items-center">
    @foreach ($questions as $question)
        <div class="p-6 bg-white rounded-lg shadow w-full max-w-2xl">
            <p class="mb-6 text-xl font-semibold text-gray-800">
                {{ $question->question_text }}
            </p>
            <div class="flex flex-wrap items-center gap-6 justify-center">
                @foreach ($likertScales as $scale)
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="question_{{ $question->id }}" value="{{ $scale->likert_value }}"
                            class="form-radio h-6 w-6 text-blue-600 border-gray-300 focus:ring-blue-500">
                        <span class="ml-3 text-gray-700">
                            {{ $scale->description }}
                        </span>
                    </label>
                @endforeach
            </div>
        </div>
    @endforeach
</div>