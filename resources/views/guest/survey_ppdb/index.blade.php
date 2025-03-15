<x-layout>
    <div class="container my-5 d-flex justify-content-center">
        @if($step == 1)
            @include('guest.survey_ppdb.responden')
        @elseif($step == 2)
            @include('guest.survey_ppdb.kuesioner', ['respondent_id' => $respondent_id, 'questions' => $questions])
        @endif
    </div>
</x-layout>