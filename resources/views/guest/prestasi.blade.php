<x-layout></x-layout>
<div class="container mx-auto pt-5 px-4">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Selamat Datang di Website Prestasi MAN 1 Kota Bogor</h2>
        </div>
    </div>
    <div x-show="tahun"
                        class="w-full overflow-x-auto mx-auto flex items-center relative shadow-md sm:rounded-lg my-6">
                        <table class="w-full max-w-full rtl:justify-left text-sm text-left text-gray-500 my-3">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="id_calon_siswa"
                                            class="text-gray-700">No</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="nama_lengkap"
                                            class="text-gray-700">Nama Prestasi</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="NISN"
                                            class="text-gray-700">Tempat</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="sekolah_asal"
                                            class="text-gray-700">Tingkat</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="jenis_kelamin"
                                            class="text-gray-700">Tahun</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="total_rata_nilai"
                                            class="text-gray-700">Juara</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="status"
                                            class="text-gray-700">Kategori</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td colspan="10" class="px-6 py-3 text-center text-red-500">
                                            DATA TIDAK DITEMUKAN
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>