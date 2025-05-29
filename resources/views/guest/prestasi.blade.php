<x-layout>
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Daftar Prestasi MAN 1 Kota Bogor</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Kelas/Jabatan</th>
                        <th class="px-4 py-2 border">Kejuaraan</th>
                        <th class="px-4 py-2 border">Bidang</th>
                        <th class="px-4 py-2 border">Tingkat</th>
                        <th class="px-4 py-2 border">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prestasi as $item)
                    <tr>
                        <td class="px-4 py-2 border text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">{{ $item->nama }}</td>
                        <td class="px-4 py-2 border">{{ $item->kelas_jabatan }}</td>
                        <td class="px-4 py-2 border">{{ $item->kejuaraan }}</td>
                        <td class="px-4 py-2 border">{{ $item->bidang }}</td>
                        <td class="px-4 py-2 border">{{ $item->tingkat }}</td>
                        <td class="px-4 py-2 border">{{ $item->keterangan }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-2 border text-center">Belum ada data prestasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>