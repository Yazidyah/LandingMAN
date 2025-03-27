<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">
                <h1 class="font-bold text-[32px] pt-7 pb-7 ">Indeks Kepuasan Masyarakat</h1>
                <!-- Filter Dropdown -->
                <form method="GET" action="{{ route('admin.ikm.index') }}" class="mb-6">
                    <select name="survey_id" class="border border-gray-300 rounded p-2">
                        <option value="">Semua Survey</option>
                        @foreach ($allSurveys as $survey)
                            <option value="{{ $survey->id }}" {{ request('survey_id') == $survey->id ? 'selected' : '' }}>
                                {{ $survey->survey_name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="mt-4 px-4 py-2 inline-flex justify-center items-center  bg-tertiary border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-tertiary active:bg-tertiary active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2  transition ease-in-out duration-150 roundedz">Filter</button>
                </form>
                <!-- Container untuk 2 Card Tambahan -->
                <div class="flex flex-wrap gap-5 mt-4">
                    <!-- Card Tambahan 1 -->
                    <div class="bg-white overflow-hidden shadow sm:rounded-lg flex-1 min-w-[300px]">
                        <div class="px-4 py-5 sm:p-6">
                            <dl>
                                <dt class="text-sm leading-5 font-medium text-gray-500 truncate dark:text-gray-400">
                                    Indeks Kepuasan Masyarakat</dt>
                                <dd class="mt-1 text-2xl leading-9 font-semibold text-indigo-600 dark:text-indigo-400">
                                    {{ number_format($ikm, 1) }}%</dd>
                            </dl>
                        </div>
                    </div>
                    <!-- Card Tambahan 2 -->
                    <div class="bg-white overflow-hidden shadow sm:rounded-lg flex-1 min-w-[300px]">
                        <div class="px-4 py-5 sm:p-6">
                            <dl>
                                <dt class="text-sm leading-5 font-medium text-gray-500 truncate dark:text-gray-400">
                                    Kinerja Unit Pelayanan</dt>
                                <dd class="mt-1 text-2xl leading-9 font-semibold text-indigo-600 dark:text-indigo-400">
                                    {{ $rating }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Container untuk Card Statistik -->
                <div class="flex flex-wrap gap-5 mt-4">
                    <!-- Card Statistik 1 -->
                    <div class="bg-white overflow-hidden shadow sm:rounded-lg flex-1 min-w-[200px]">
                        <div class="px-4 py-5 sm:p-6">
                            <dl>
                                <dt class="text-sm leading-5 font-medium text-gray-500 truncate dark:text-gray-400">
                                    Jumlah Pertanyaan</dt>
                                <dd class="mt-1 text-3xl leading-9 font-semibold text-indigo-600 dark:text-indigo-400">
                                    {{ $jumlahPertanyaan }}</dd>
                            </dl>
                        </div>
                    </div>
                    <!-- Card Statistik 2 -->
                    <div class="bg-white overflow-hidden shadow sm:rounded-lg flex-1 min-w-[200px]">
                        <div class="px-4 py-5 sm:p-6">
                            <dl>
                                <dt class="text-sm leading-5 font-medium text-gray-500 truncate dark:text-gray-400">
                                    Jumlah Jawaban</dt>
                                <dd class="mt-1 text-3xl leading-9 font-semibold text-indigo-600 dark:text-indigo-400">
                                    {{ $jumlahJawaban }}</dd>
                            </dl>
                        </div>
                    </div>
                    <!-- Card Statistik 3 -->
                    <div class="bg-white overflow-hidden shadow sm:rounded-lg flex-1 min-w-[200px]">
                        <div class="px-4 py-5 sm:p-6">
                            <dl>
                                <dt class="text-sm leading-5 font-medium text-gray-500 truncate dark:text-gray-400">
                                    Jumlah Responden</dt>
                                <dd class="mt-1 text-3xl leading-9 font-semibold text-indigo-600 dark:text-indigo-400">
                                    {{ $jumlahResponden }}</dd>
                            </dl>
                        </div>
                    </div>
                    <!-- Card Statistik 4 -->
                    <div class="bg-white overflow-hidden shadow sm:rounded-lg flex-1 min-w-[200px]">
                        <div class="px-4 py-5 sm:p-6">
                            <dl>
                                <dt class="text-sm leading-5 font-medium text-gray-500 truncate dark:text-gray-400">
                                    Kritik dan Saran</dt>
                                <dd class="mt-1 text-3xl leading-9 font-semibold text-indigo-600 dark:text-indigo-400">
                                    {{ $jumlahKritikSaran }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Container untuk Chart dengan Layout Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-5 mt-4">
                    <!-- Chart Container 1 -->
                    <div class="bg-white overflow-hidden shadow sm:rounded-lg p-4">
                        <p class="text-center text-gray-500">Berdasarkan Jawaban</p>
                        <canvas id="ikmChart" class="w-64 h-64 mx-auto"></canvas>
                    </div>
                    <!-- Chart Container 2 -->
                    <div class="col-span-3 bg-white overflow-hidden shadow sm:rounded-lg p-4">
                        <canvas id="newChart" class="w-full h-64 mx-auto"></canvas>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-5 mt-4">
                    <div class="bg-white overflow-hidden shadow sm:rounded-lg p-4">
                        <p class="text-center text-gray-500">Grafik Responden Berdasarkan Jenis kelamin</p>
                        <canvas id="jenisKelaminChart" class="w-64 h-64 mx-auto"></canvas>
                    </div>
                    <div class="bg-white overflow-hidden shadow sm:rounded-lg p-4">
                        <p class="text-center text-gray-500">Grafik Responden Berdasarkan Umur</p>
                        <canvas id="usiaChart" class="w-64 h-64 mx-auto"></canvas>
                    </div>
                    <div class="bg-white overflow-hidden shadow sm:rounded-lg p-4">
                        <p class="text-center text-gray-500">Grafik Responden Berdasarkan Pendidikan</p>
                        <canvas id="pendidikanChart" class="w-64 h-64 mx-auto"></canvas>
                    </div>
                    <div class="bg-white overflow-hidden shadow sm:rounded-lg p-4">
                        <p class="text-center text-gray-500">Grafik Responden Berdasarkan Pekerjaan</p>
                        <canvas id="pekerjaanChart" class="w-64 h-64 mx-auto"></canvas>
                    </div>
                </div>
                <!-- Minimize/Show Table Button -->
                <button id="toggleTableButton"
                    class="mb-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700 float-left flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M9.47 6.47a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 1 1-1.06 1.06L10 8.06l-3.72 3.72a.75.75 0 0 1-1.06-1.06l4.25-4.25Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Table to display questions -->
                <div id="tableContainer">
                    <table
                        class="table-auto overflow-x-auto mx-auto items-center relative shadow-md sm:rounded-lg my-6 w-full max-w-full rtl:justify-left text-sm text-left text-gray-500">
                        <thead class="w-full max-w-full rtl:justify-left text-lg text-left text-gray-500 my-3">
                            <tr class="text-xs text-tertiary uppercase bg-gray-50 text-center">
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Pertanyaan</th>
                                <th scope="col" class="px-6 py-3">Survey</th>
                                <th scope="col" class="px-6 py-3">Jumlah Nilai per Unsur</th>
                                <th scope="col" class="px-6 py-3">NRR per Unsur</th>
                                <th scope="col" class="px-6 py-3">Bobot Nilai Tetimbang</th>
                                <th scope="col" class="px-6 py-3">NRR Tetimbang per Unsur</th>
                            </tr>
                        </thead>
                        <tbody class="text-left">
                            @php $index = 1; @endphp
                            @foreach ($surveys as $survey)
                                @foreach ($survey->questions as $question)
                                    <tr>
                                        <td class="px-6 py-3 text-center">{{ $index++ }}</td>
                                        <td class="px-6 py-3 text-center">{{ $question->question_text }}</td>
                                        <td class="px-6 py-3 text-center">{{ $question->survey->survey_name }}</td>
                                        <td class="px-6 py-3 text-center">{{ $jumlahNilaiUnsur[$question->id] ?? 0 }}</td>
                                        <td class="px-6 py-3 text-center">{{ number_format($nrrUnsur[$question->id] ?? 0, 2) }}
                                        </td>
                                        <td class="px-6 py-3 text-center">{{ number_format($bobotNilaiTetimbang, 3) }}</td>
                                        <td class="px-6 py-3 text-center">
                                            {{ number_format($tetimbangPerUnsur[$question->id] ?? 0, 3) }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-6">
                        <h3 class="text-[20px]">IKM: {{ number_format($ikm, 1) }}%</h3>
                        <h3 class="text-[20px]">Bobot Nilai Tetimbang: {{ number_format($bobotNilaiTetimbang, 3) }}</h3>
                        <h3 class="text-[20px]">Kinerja Unit Pelayanan: {{ $rating }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const chartColors = [
            'rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 
            'rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)', 'rgba(255, 159, 64, 0.5)'
        ];
        const chartBorderColors = chartColors.map(color => color.replace('0.5', '1'));

        const chartConfigs = [
            { 
                id: 'ikmChart', 
                data: @json(array_values($likertCounts)), 
                labels: ['Skala 1', 'Skala 2', 'Skala 3', 'Skala 4'] 
            },
            { 
                id: 'jenisKelaminChart', 
                data: [@json($jenisKelaminData['l'] ?? 0), @json($jenisKelaminData['p'] ?? 0)], 
                labels: ['Laki-laki', 'Perempuan'] 
            },
            { 
                id: 'usiaChart', 
                data: [
                    @json($usiaData['Anak-anak(0-12)'] ?? 0), 
                    @json($usiaData['Remaja(13-19)'] ?? 0), 
                    @json($usiaData['Dewasa(20-59)'] ?? 0), 
                    @json($usiaData['Lansia(>=50)'] ?? 0)
                ], 
                labels: ['Anak-anak(0-12)', 'Remaja(13-19)', 'Dewasa(20-59)', 'Lansia(>=50)'] 
            },
            { 
                id: 'pendidikanChart', 
                data: [
                    @json($pendidikanData['s3'] ?? 0), 
                    @json($pendidikanData['s2'] ?? 0), 
                    @json($pendidikanData['s1'] ?? 0), 
                    @json($pendidikanData['d3'] ?? 0), 
                    @json($pendidikanData['sma/smk/sederajat'] ?? 0), 
                    @json($pendidikanData['smp/sederajat'] ?? 0), 
                    @json($pendidikanData['sd/sederajat'] ?? 0)
                ], 
                labels: ['S3', 'S2', 'S1', 'D3', 'SMA/SMK/Sederajat', 'SMP/Sederajat', 'SD/Sederajat'] 
            },
            { 
                id: 'pekerjaanChart', 
                data: [
                    @json($pekerjaanData['wiraswasta'] ?? 0), 
                    @json($pekerjaanData['wirausaha'] ?? 0), 
                    @json($pekerjaanData['pns'] ?? 0), 
                    @json($pekerjaanData['tni'] ?? 0), 
                    @json($pekerjaanData['polri'] ?? 0), 
                    @json($pekerjaanData['lainnya'] ?? 0)
                ], 
                labels: ['Wiraswasta', 'Wirausaha', 'PNS', 'TNI', 'Polri', 'Lainnya'] 
            }
        ];

        chartConfigs.forEach(config => {
            const ctx = document.getElementById(config.id).getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: config.labels,
                    datasets: [{
                        data: config.data,
                        backgroundColor: chartColors,
                        borderColor: chartBorderColors,
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 20, // Adjust the size of the legend box
                                padding: 15, // Add padding between labels
                                font: {
                                    size: 12 // Set font size for labels
                                }
                            }
                        }
                    },
                    layout: {
                        padding: {
                            top: 10, // Add padding to the top
                            bottom: 10 // Add padding to the bottom
                        }
                    }
                }
            });
        });

        // Toggle table visibility with animation
        const toggleTableButton = document.getElementById('toggleTableButton');
        const tableContainer = document.getElementById('tableContainer');

        const setCookie = (name, value, days) => {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = `${name}=${btoa(value)};expires=${date.toUTCString()};path=/`;
        };

        const getCookie = (name) => {
            const cookies = document.cookie.split('; ');
            for (let cookie of cookies) {
                const [key, value] = cookie.split('=');
                if (key === name) return atob(value);
            }
            return null;
        };

        const slideUp = (element, duration = 300) => {
            element.style.transition = `height ${duration}ms ease-out, opacity ${duration}ms ease-out`;
            element.style.height = `${element.offsetHeight}px`;
            element.offsetHeight; // Trigger reflow
            element.style.overflow = 'hidden';
            element.style.height = '0';
            element.style.opacity = '0';
            setTimeout(() => {
                element.style.display = 'none';
            }, duration);
        };

        const slideDown = (element, duration = 300) => {
            element.style.removeProperty('display');
            let display = window.getComputedStyle(element).display;
            if (display === 'none') display = 'block';
            const height = element.offsetHeight;
            element.style.overflow = 'hidden';
            element.style.height = '0';
            element.style.opacity = '0';
            element.offsetHeight; // Trigger reflow
            element.style.transition = `height ${duration}ms ease-out, opacity ${duration}ms ease-out`;
            element.style.height = `${height}px`;
            element.style.opacity = '1';
            setTimeout(() => {
                element.style.removeProperty('height');
                element.style.removeProperty('opacity');
                element.style.removeProperty('overflow');
                element.style.removeProperty('transition');
            }, duration);
        };

        // Initialize table visibility based on cookie
        const tableState = getCookie('tableVisible');
        if (tableState === 'hidden') {
            tableContainer.style.display = 'none';
            toggleTableButton.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
            `;
        }

        toggleTableButton.addEventListener('click', () => {
            if (tableContainer.style.display === 'none' || window.getComputedStyle(tableContainer).display === 'none') {
                slideDown(tableContainer);
                setCookie('tableVisible', 'visible', 1);
                toggleTableButton.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd" d="M9.47 6.47a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 1 1-1.06 1.06L10 8.06l-3.72-3.72a.75.75 0 0 1-1.06-1.06l4.25-4.25Z" clip-rule="evenodd" />
                    </svg>
                `;
            } else {
                slideUp(tableContainer);
                setCookie('tableVisible', 'hidden', 1);
                toggleTableButton.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                `;
            }
        });
    </script>
</x-app-layout>