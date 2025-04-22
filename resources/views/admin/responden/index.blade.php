<x-app-layout>
<div class="p-4 sm:ml-64">
<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
    <div class="container mx-auto text-center pt-7">
        <h1 class="font-bold text-[32px] pt-7 pb-7">Daftar Responden</h1>
        
        <!-- Filters -->
        <form method="GET" action="{{ route('admin.responden.index') }}" class="mb-6">
            
        <div class="relative inline-block w-64 mb-4">
                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="block w-full bg-white border border-gray-300 hover:border-gray-tertiary px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <label for="start_date" class="absolute left-3 top-0 text-gray-600 text-xs transform -translate-y-1/2 bg-white px-1 rounded-lg ">Tanggal Mulai</label>
            </div>

            <div class="relative inline-block w-64 mb-4">
                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="block w-full bg-white border border-gray-300 hover:border-gray-tertiary px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <label for="end_date" class="absolute left-3 top-0 text-gray-600 text-xs transform -translate-y-1/2 bg-white px-1 rounded-lg ">Tanggal Selesai</label>
            </div>
            
            <div class="relative inline-block w-64 mb-4">
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari Nama..." class="block w-full bg-white border border-gray-300 hover:border-gray-tertiary px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <label for="search" class="absolute left-3 top-0 text-gray-600 text-xs transform -translate-y-1/2 bg-white px-1 rounded-lg ">Cari Nama</label>
            </div>

            <div class="relative inline-block w-64 mb-4">
                <select name="age_filter" id="age_filter" class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-tertiary px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="all" {{ request('age_filter') == 'all' ? 'selected' : '' }}>Semua</option>
                    <option value="anak-anak" {{ request('age_filter') == 'anak-anak' ? 'selected' : '' }}>Anak-anak</option>
                    <option value="remaja" {{ request('age_filter') == 'remaja' ? 'selected' : '' }}>Remaja</option>
                    <option value="dewasa" {{ request('age_filter') == 'dewasa' ? 'selected' : '' }}>Dewasa</option>
                    <option value="lansia" {{ request('age_filter') == 'lansia' ? 'selected' : '' }}>Lansia</option>
                </select>

                <label for="age_filter" class="absolute left-3 top-0 text-gray-600 text-xs transform -translate-y-1/2 bg-white px-1 rounded-lg ">Filter Umur</label>
            </div>

            <div class="relative inline-block w-64 mb-4">
                <select name="education_filter" id="education_filter" class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-tertiary px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="all" {{ request('education_filter') == 'all' ? 'selected' : '' }}>Semua</option>
                    <option value="s3" {{ request('education_filter') == 's3' ? 'selected' : '' }}>S3</option>
                    <option value="s2" {{ request('education_filter') == 's2' ? 'selected' : '' }}>S2</option>
                    <option value="s1" {{ request('education_filter') == 's1' ? 'selected' : '' }}>S1</option>
                    <option value="d3" {{ request('education_filter') == 'd3' ? 'selected' : '' }}>D3</option>
                    <option value="sma/smk/sederajat" {{ request('education_filter') == 'sma/smk/sederajat' ? 'selected' : '' }}>SMA/SMK/Sederajat</option>
                    <option value="smp/sederajat" {{ request('education_filter') == 'smp/sederajat' ? 'selected' : '' }}>SMP/Sederajat</option>
                    <option value="sd/sederajat" {{ request('education_filter') == 'sd/sederajat' ? 'selected' : '' }}>SD/Sederajat</option>
                </select>

                <label for="education_filter" class="absolute left-3 top-0 text-gray-600 text-xs transform -translate-y-1/2 bg-white px-1 rounded-lg ">Filter Pendidikan</label>
            </div>

            <div class="relative inline-block w-64 mb-4">
                <select name="gender_filter" id="gender_filter" class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-tertiary px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="all" {{ request('gender_filter') == 'all' ? 'selected' : '' }}>Semua</option>
                    <option value="l" {{ request('gender_filter') == 'l' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="p" {{ request('gender_filter') == 'p' ? 'selected' : '' }}>Perempuan</option>
                </select>

                <label for="gender_filter" class="absolute left-3 top-0 text-gray-600 text-xs transform -translate-y-1/2 bg-white px-1 rounded-lg ">Filter Jenis Kelamin</label>
            </div>

            <div class="relative inline-block w-64 mb-4">
                <select name="job_filter" id="job_filter" class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-tertiary px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="all" {{ request('job_filter') == 'all' ? 'selected' : '' }}>Semua</option>
                    <option value="pelajar" {{ request('job_filter') == 'pelajar' ? 'selected' : '' }}>Pelajar</option>
                    <option value="mahasiswa" {{ request('job_filter') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="wiraswasta" {{ request('job_filter') == 'wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                    <option value="wirausaha" {{ request('job_filter') == 'wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                    <option value="pns" {{ request('job_filter') == 'pns' ? 'selected' : '' }}>PNS</option>
                    <option value="tni" {{ request('job_filter') == 'tni' ? 'selected' : '' }}>TNI</option>
                    <option value="polri" {{ request('job_filter') == 'polri' ? 'selected' : '' }}>POLRI</option>
                    <option value="lainnya" {{ request('job_filter') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>

                <label for="job_filter" class="absolute left-3 top-0 text-gray-600 text-xs transform -translate-y-1/2 bg-white px-1 rounded-lg">Filter Pekerjaan</label>
            </div>
            <div class="relative inline-block w-64 mb-4">
                <select name="per_page" id="per_page" class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-tertiary px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="5" {{ request('per_page') == '5' ? 'selected' : '' }}>5</option>
                    <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25</option>
                    <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100</option>
                </select>

                <label for="per_page" class="absolute left-3 top-0 text-gray-600 text-xs transform -translate-y-1/2 bg-white px-1 rounded-lg ">Items per Page</label>
            </div>

            <div class="mt-4">
                <button type="submit" class="mt-4 px-4 py-2 inline-flex justify-center items-center  bg-tertiary border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-tertiary active:bg-tertiary active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2  transition ease-in-out duration-150 rounded w-1/2">Filter</button>
            </div>
        </form>

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
                @forelse($respondents as $respondent)
                <tr class="hover:bg-gray-200 transition duration-200 cursor-pointer">
                    <td class="py-2">{{ strtoupper($respondent->nama_lengkap) }}</td>
                    <td class="py-2">{{ $respondent->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td class="py-2">{{ $respondent->usia }}</td>
                    <td class="py-2">{{ strtoupper($respondent->pendidikan) }}</td>
                    <td class="py-2">{{ strtoupper($respondent->pekerjaan) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-4 text-gray-500">Data tidak ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>



