<x-app-layout>
<div class="p-4 sm:ml-64">
<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
    <div class="container mx-auto text-center pt-7">
        <h1 class="font-bold text-[32px] pt-7 pb-7 ">Daftar Responden</h1>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">Nama Lengkap</th>
                    <th class="py-2">Jenis Kelamin</th>
                    <th class="py-2">Usia</th>
                    <th class="py-2">Pendidikan</th>
                    <th class="py-2">Pekerjaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($respondents as $respondent)
                <tr>
                    <td class="border px-4 py-2">{{ $respondent->nama_lengkap }}</td>
                    <td class="border px-4 py-2">{{ $respondent->jenis_kelamin }}</td>
                    <td class="border px-4 py-2">{{ $respondent->usia }}</td>
                    <td class="border px-4 py-2">{{ $respondent->pendidikan }}</td>
                    <td class="border px-4 py-2">{{ $respondent->pekerjaan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>



