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
                <table class="table-auto overflow-x-auto mx-auto items-center relative shadow-md sm:rounded-lg my-6 w-full max-w-full rtl:justify-left text-sm text-left text-gray-500">
                    <thead class="w-full max-w-full rtl:justify-left text-lg text-left text-gray-500 my-3">
                        <tr class="text-sm text-tertiary uppercase bg-gray-50 text-center">
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Survey ID</th>
                            <th class="px-6 py-3">Respondent ID</th>
                            <th class="px-6 py-3">Kritik</th>
                            <th class="px-6 py-3">Saran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $feedback)
                            <tr class="hover:bg-gray-200 transition duration-200 cursor-pointer">
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



