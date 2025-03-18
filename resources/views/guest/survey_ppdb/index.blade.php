<x-layout>
    <div class="max-w-lg mx-auto my-5 bg-white p-6 border border-gray-200 rounded-lg shadow">
        <h2>SURVEY KEPUASAN PPDB</h2>
        <form action="{{ route('ppdb.survey.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama_lengkap" class="block text-sm font-medium text-gray-900">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
            </div>
            <div class="mb-4">
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-900">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="l">Laki-laki</option>
                    <option value="p">Perempuan</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="usia" class="block text-sm font-medium text-gray-900">Usia</label>
                <input type="number" id="usia" name="usia"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
            </div>
            <div class="mb-4">
                <label for="pendidikan" class="block text-sm font-medium text-gray-900">Pendidikan</label>
                <select id="pendidikan" name="pendidikan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
                    <option value="s3">S3</option>
                    <option value="s2">S2</option>
                    <option value="s1">S1</option>
                    <option value="d3">D3</option>
                    <option value="sma/smk/sederajat">SMA/SMK/Sederajat</option>
                    <option value="smp/sederajat">SMP/Sederajat</option>
                    <option value="sd/sederajat">SD/Sederajat</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="pekerjaan" class="block text-sm font-medium text-gray-900">Pekerjaan</label>
                <select id="pekerjaan" name="pekerjaan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required>
                    <option value="pns">PNS</option>
                    <option value="tni">TNI</option>
                    <option value="polri">POLRI</option>
                    <option value="wiraswasta">WIRASWASTA</option>
                    <option value="wirausaha">WIRAUSAHA</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>
            @foreach($questions as $question)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-900">{{ $question->question_text }}</label>
                    <div class="flex flex-col space-y-2">
                        @foreach([1 => 'Sangat Tidak Puas', 2 => 'Tidak Puas', 3 => 'Netral', 4 => 'Puas', 5 => 'Sangat Puas'] as $value => $label)
                            <label class="inline-flex items-center">
                                <input type="radio" name="question_{{ $question->id }}" value="{{ $value }}"
                                    class="form-radio text-blue-600 focus:ring-blue-500" required>
                                <span class="ml-2">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <button type="submit"
                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
        </form>
    </div>

</x-layout>