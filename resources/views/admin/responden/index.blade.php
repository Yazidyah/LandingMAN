<x-app-layout>
<div class="p-4 sm:ml-64">
<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
    <div class="container mx-auto text-center pt-7">
        <h1 class="font-bold text-[32px] pt-7 pb-7">Daftar Responden</h1>
        <table class="table-auto overflow-x-auto mx-auto items-center relative shadow-md sm:rounded-lg my-6 w-full max-w-full rtl:justify-left text-sm text-left text-gray-500">
            <thead class="w-full max-w-full rtl:justify-left text-lg text-left text-gray-500 my-3">
                <tr class="text-sm text-tertiary uppercase bg-gray-50 text-center">
                    <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                    <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
                    <th scope="col" class="px-6 py-3">Usia</th>
                    <th scope="col" class="px-6 py-3">Pendidikan</th>
                    <th scope="col" class="px-6 py-3">Pekerjaan</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($respondents as $respondent)
                <tr class="hover:bg-gray-200 transition duration-200 cursor-pointer">
                    <td class="py-2">{{ strtoupper($respondent->nama_lengkap) }}</td>
                    <td class="py-2">{{ $respondent->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td class="py-2">{{ $respondent->usia }}</td>
                    <td class="py-2">{{ strtoupper($respondent->pendidikan) }}</td>
                    <td class="py-2">{{ strtoupper($respondent->pekerjaan) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>



