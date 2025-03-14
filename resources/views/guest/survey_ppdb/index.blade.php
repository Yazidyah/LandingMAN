<x-layout>
    <div class="container my-5 d-flex justify-content-center">
        @if($step == 1)
            @include('guest.survey_ppdb.responden')
        @elseif($step == 2)
            @include('guest.survey_ppdb.kuesioner')
        @endif
    </div>
</x-layout>