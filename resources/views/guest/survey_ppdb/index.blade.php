<x-layout>
    <div class="max-w-5xl mx-auto my-5 bg-white p-8 border border-gray-200 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold text-gray-900 text-center mb-4">SURVEY KEPUASAN PPDB</h2>
        <form action="{{ route('ppdb.survey.store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="nama_lengkap" class="block text-sm font-medium text-gray-900">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-tertiary focus:border-tertiary block w-full p-3"
                    required>
            </div>
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="usia" class="block text-sm font-medium text-gray-900">Usia</label>
                    <input type="number" id="usia" name="usia"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-tertiary focus:border-tertiary block w-full p-3"
                        required>
                </div>
                <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-900">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-tertiary focus:border-tertiary block w-full p-3"
                        required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="l">Laki-laki</option>
                        <option value="p">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label for="pendidikan" class="block text-sm font-medium text-gray-900">Pendidikan</label>
                    <select id="pendidikan" name="pendidikan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-tertiary focus:border-tertiary block w-full p-2.5"
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
                <div>
                    <label for="pekerjaan" class="block text-sm font-medium text-gray-900">Pekerjaan</label>
                    <select id="pekerjaan" name="pekerjaan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-tertiary focus:border-tertiary block w-full p-2.5"
                        required>
                        <option value="pelajar">PELAJAR</option>
                        <option value="mahasiswa">MAHASISWA</option>
                        <option value="wiraswasta">WIRASWASTA</option>
                        <option value="wirausaha">WIRAUSAHA</option>
                        <option value="pns">PNS</option>
                        <option value="tni">TNI</option>
                        <option value="polri">POLRI</option>
                        <option value="lainnya">LAINNYA</option>
                    </select>
                </div>
            </div>
            @foreach($questions as $question)
                        <div class="mb-6">
                            <label class="block text-xl font-medium text-gray-900">{{ $question->question_text }}</label>
                            <div class="rating flex flex-row-reverse gap-6 mt-2 justify-center relative">
                                @php
                                    $labels = ['Tidak Puas', 'Kurang Puas', 'Puas', 'Sangat Puas'];
                                @endphp
                                @for ($i = 4; $i >= 1; $i--)
                                    <input type="radio" id="star-{{ $question->id }}-{{ $i }}" name="question_{{ $question->id }}"
                                        value="{{ $i }}" required>
                                    <label for="star-{{ $question->id }}-{{ $i }}" class="group relative">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-16 h-16">
                                            <path pathLength="360"
                                                d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                            </path>
                                        </svg>
                                        <span
                                            class="tooltip absolute bottom-14 left-1/2 transform -translate-x-1/2 scale-0 group-hover:scale-100 bg-gray-800 text-white text-sm rounded px-3 py-1 transition-all duration-200">
                                            {{ $labels[$i - 1] }}
                                        </span>
                                    </label>
                                @endfor
                            </div>
                        </div>
            @endforeach
            <button type="submit"
                class="w-full text-white bg-tertiary hover:bg-secondary hover:text-tertiary focus:ring-4 focus:outline-none focus:ring-tertiary font-medium rounded-lg text-lg px-6 py-3 text-center">
                Submit
            </button>
        </form>
    </div>

    <style>
        .rating {
            --stroke: #666;
            --fill: #ffc73a;
        }

        .rating input {
            appearance: unset;
            position: absolute;
            opacity: 0;
        }

        .rating label {
            cursor: pointer;
            position: relative;
        }

        .rating svg {
            width: 2rem;
            height: 2rem;
            fill: transparent;
            stroke: var(--stroke);
            transition: stroke 0.2s, fill 0.5s;
        }

        .rating label:hover svg,
        .rating input:checked~label svg {
            fill: var(--fill);
            stroke: var(--fill);
        }

        .tooltip {
            opacity: 0;
            visibility: hidden;
            transform: scale(0);
            transition: opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
        }

        .group:hover .tooltip {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
        }
    </style>
</x-layout>