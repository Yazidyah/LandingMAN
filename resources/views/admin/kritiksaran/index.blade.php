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
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2">ID</th>
                            <th class="py-2">Survey ID</th>
                            <th class="py-2">Respondent ID</th>
                            <th class="py-2">Kritik</th>
                            <th class="py-2">Saran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $feedback)
                            <tr>
                                <td class="py-2">{{ $feedback->id }}</td>
                                <td class="py-2">{{ $feedback->survey_id }}</td>
                                <td class="py-2">{{ $feedback->respondent_id }}</td>
                                <td class="py-2">{{ $feedback->kritik }}</td>
                                <td class="py-2">{{ $feedback->saran }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>



