<form action="{{ route('respondents.store') }}" method="POST" class="max-w-xl mx-auto">
    @csrf
    <input type="hidden" name="step" value="2">
    <div class="mb-5">
        <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap:</label>
        <input type="text" id="nama_lengkap" name="nama_lengkap" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
    </div>
    <div class="mb-5">
        <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin:</label>
        <select id="jenis_kelamin" name="jenis_kelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            <option value="l">Laki-laki</option>
            <option value="p">Perempuan</option>
        </select>
    </div>
    <div class="mb-5">
        <label for="usia" class="block mb-2 text-sm font-medium text-gray-900">Usia:</label>
        <input type="number" id="usia" name="usia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
    </div>
    <div class="mb-5">
        <label for="pendidikan" class="block mb-2 text-sm font-medium text-gray-900">Pendidikan:</label>
        <select id="pendidikan" name="pendidikan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            <option value="s3">S3</option>
            <option value="s2">S2</option>
            <option value="s1">S1</option>
            <option value="d3">D3</option>
            <option value="sma/smk/sederajat">SMA/SMK/Sederajat</option>
            <option value="smp/sederajat">SMP/Sederajat</option>
            <option value="sd/sederajat">SD/Sederajat</option>
        </select>
    </div>
    <div class="mb-5">
        <label for="pekerjaan" class="block mb-2 text-sm font-medium text-gray-900">Pekerjaan:</label>
        <select id="pekerjaan" name="pekerjaan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            <option value="pns">PNS</option>
            <option value="tni">TNI</option>
            <option value="polri">POLRI</option>
            <option value="wiraswasta">WIRASWASTA</option>
            <option value="wirausaha">WIRAUSAHA</option>
            <option value="lainnya">Lainnya</option>
        </select>
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
</form>
