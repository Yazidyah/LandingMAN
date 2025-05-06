<x-layout>
    <div x-data="{ 
        step: 1, 
        form: { nama_lengkap: '', usia: '', jenis_kelamin: '', pendidikan: '', pekerjaan: '' },
        isStep1Valid() {
            return this.form.nama_lengkap && this.form.usia && this.form.jenis_kelamin && this.form.pendidikan && this.form.pekerjaan;
        }
    }" class="min-h-[90vh]">
        <form action="{{ route('guest.survey.store') }}" method="POST">
            @csrf
            {{-- Instructions --}}
            {{-- Step 1: Identitas --}}
            <div x-show="step === 1"
                class="max-w-5xl mx-auto my-5 bg-white p-8 border border-gray-200 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold text-gray-900 text-center mb-4">SURVEY KEPUASAN</h2>
                <div class="mb-6">
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-900">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" x-model="form.nama_lengkap"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-tertiary focus:border-tertiary block w-full p-3"
                        required>
                </div>
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="usia" class="block text-sm font-medium text-gray-900">Usia</label>
                        <input type="number" id="usia" name="usia" x-model="form.usia"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-tertiary focus:border-tertiary block w-full p-3"
                            required>
                    </div>
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-900">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" x-model="form.jenis_kelamin"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-tertiary focus:border-tertiary block w-full p-3"
                            required>
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="l">Laki-laki</option>
                            <option value="p">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label for="pendidikan" class="block text-sm font-medium text-gray-900">Pendidikan</label>
                        <select id="pendidikan" name="pendidikan" x-model="form.pendidikan"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-tertiary focus:border-tertiary block w-full p-2.5"
                            required>
                            <option value="" disabled selected>Pilih Tingkat Pendidikan</option>
                            <option value="s3">S3</option>
                            <option value="s2">S2</option>
                            <option value="s1">S1</option>
                            <option value="d3">D3</option>
                            <option value="sma/smk/sederajat">SMA/SMK/Sederajat</option>
                            <option value="smp/sederajat">SMP/Sederajat</option>
                            <option value="sd/sederajat">SD/Sederajat</option>
                        </select>
                    </div>
                    <div>
                        <label for="pekerjaan" class="block text-sm font-medium text-gray-900">Pekerjaan</label>
                        <select id="pekerjaan" name="pekerjaan" x-model="form.pekerjaan"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-tertiary focus:border-tertiary block w-full p-2.5"
                            required>
                            <option value="" disabled selected>Pilih Pekerjaan</option>
                            <option value="wiraswasta">WIRASWASTA</option>
                            <option value="wirausaha">WIRAUSAHA</option>
                            <option value="pns">PNS</option>
                            <option value="tni">TNI</option>
                            <option value="polri">POLRI</option>
                            <option value="lainnya">LAINNYA</option>
                        </select>
                    </div>
                </div>
                <div class="text-sm text-gray-600 mt-4 border-t border-gray-200 p-4">
                    <p class="leading-relaxed">
                        Mohon isi data diri Anda dengan jujur, lengkap, dan dapat dipertanggungjawabkan. Data yang Anda berikan akan digunakan untuk keperluan analisis dan peningkatan layanan kami. 
                        Pastikan semua informasi yang dimasukkan sesuai dengan kondisi sebenarnya. Terima kasih atas kepercayaan dan partisipasi Anda.
                    </p>
                </div>
                <button type="button" @click="step = 2" :disabled="!isStep1Valid()"
                    class="w-full text-white bg-tertiary hover:bg-secondary hover:text-tertiary font-medium rounded-lg text-lg px-6 py-3 text-center"
                    :class="{ 'opacity-50 cursor-not-allowed': !isStep1Valid() }">
                    Lanjut
                </button>
            </div>

            {{-- Step 2: Pertanyaan Survey --}}
            <div x-show="step === 2">
            <div class="max-w-5xl mx-auto my-2 bg-white p-8 border border-gray-200 rounded-lg">
                <h2 class="text-xl font-bold text-gray-900 text-center mb-4">Petunjuk Pengisian Survey</h2>
                <p class="text-gray-700 text-lg">
                    Mohon pilih angka yang paling sesuai dengan tingkat persetujuan atau kepuasan Anda terhadap pernyataan yang diberikan.
                </p>
                <ul class="list-disc list-inside text-gray-700 text-lg mt-4">
                    <li>Jika Anda merasa sangat tidak setuju atau sangat tidak puas dengan pernyataan tersebut, silakan pilih angka <strong>1</strong>.</li>
                    <li>Jika Anda merasa tidak setuju atau tidak puas dengan pernyataan tersebut, silakan pilih angka <strong>2</strong>.</li>
                    <li>Jika Anda merasa setuju atau puas dengan pernyataan tersebut, silakan pilih angka <strong>3</strong>.</li>
                    <li>Jika Anda merasa sangat setuju atau sangat puas dengan pernyataan tersebut, silakan pilih angka <strong>4</strong>.</li>
                </ul>
            </div>
                {{-- Hidden inputs for Step 1 data --}}
                <input type="hidden" name="nama_lengkap" :value="form.nama_lengkap">
                <input type="hidden" name="usia" :value="form.usia">
                <input type="hidden" name="jenis_kelamin" :value="form.jenis_kelamin">
                <input type="hidden" name="pendidikan" :value="form.pendidikan">
                <input type="hidden" name="pekerjaan" :value="form.pekerjaan">

                <div class="max-w-5xl mx-auto my-5 bg-white p-8 border border-gray-200 rounded-lg shadow-lg">
                    @foreach($questions as $index => $question)
                        <div class="mb-8 p-6 border border-gray-300 rounded-lg">
                            <div class="flex items-start mb-4">
                                <span class="text-lg font-bold text-gray-900 mr-2">{{ $index + 1 }}.</span>
                                <label class="block text-xl font-medium text-gray-900">{{ $question->question_text }}</label>
                            </div>
{{-- Ubah bagian rating di Step 2 menjadi: --}}
<div class="rating flex flex-row-reverse gap-2 mt-2 justify-center relative border-t border-gray-200 pt-4 items-center">
    <span class="absolute left-2 text-sm font-medium text-gray-700">Tidak setuju</span>
    @for ($i = 4; $i >= 1; $i--)
        <input 
            type="radio" 
            id="rate-{{ $question->id }}-{{ $i }}" 
            name="question_{{ $question->id }}" 
            value="{{ $i }}" 
            required
        >
        <label 
            for="rate-{{ $question->id }}-{{ $i }}" 
            class="box"
        >{{ $i }}</label>
    @endfor
    <span class="absolute right-2 text-sm font-medium text-gray-700">Sangat setuju</span>
</div>
                        </div>
                    @endforeach
                    <div class="mb-6">
                        <label for="kritik" class="block text-xl font-medium text-gray-900">Kritik</label>
                        <textarea id="kritik" name="kritik"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-tertiary focus:border-tertiary block w-full p-3"
                            rows="4" required></textarea>
                    </div>
                    <div class="mb-6">
                        <label for="saran" class="block text-xl font-medium text-gray-900">Saran</label>
                        <textarea id="saran" name="saran"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-tertiary focus:border-tertiary block w-full p-3"
                            rows="4" required></textarea>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-tertiary hover:bg-secondary hover:text-tertiary font-medium rounded-lg text-lg px-6 py-3 text-center">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>

    <style>
    .rating {
        /* warna default dan highlight */
        --stroke: #666;
        --fill: #006316;  /* ganti dengan warna yang kamu suka */
    }
    .rating input {
        /* sembunyikan radio button */
        appearance: none;
        position: absolute;
        opacity: 0;
    }
    .rating .box {
        /* bentuk kotak berangka */
        width: 3rem;
        height: 3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        font-weight: bold;
        border: 1px solid var(--stroke);
        color: var(--stroke);
        cursor: pointer;
        transition: background-color 0.2s, border-color 0.2s, color 0.2s;
    }
    /* efek hover: warnai dari kotak yang di-hover hingga kotak “1” */
    .rating .box:hover,
    .rating .box:hover ~ .box {
        background-color: var(--fill);
        border-color: var(--fill);
        color: #fff;
    }
    /* efek setelah memilih (checked): warnai angka ≤ nilai terpilih */
    .rating input:checked ~ .box {
        background-color: var(--fill);
        border-color: var(--fill);
        color: #fff;
    }
</style>

</x-layout>