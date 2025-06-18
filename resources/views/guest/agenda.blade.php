<x-layout>
    <div class="container mx-auto pt-5 px-4 min-h-[85vh]">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Selamat Datang di Website Agenda MAN 1 Kota Bogor</h2>
        </div>

        <!-- Form Search -->
        <form method="GET" class="mb-6 flex flex-col md:flex-row gap-2 items-center justify-end">
            <input type="text" name="search" value="{{ request('search', $search ?? '') }}" placeholder="Cari agenda..." class="border rounded px-3 py-2 w-full md:w-1/3" />
            <button type="submit" class="bg-tertiary text-white px-4 py-2 rounded hover:bg-secondary">Cari</button>
        </form>
        @if(request('search') || !empty($search))
            <p class="mb-4 text-gray-700">Hasil pencarian untuk: <span class="font-semibold">{{ request('search', $search ?? '') }}</span></p>
        @endif

        <div class="mt-8">
            @foreach($groupedNews as $monthYear => $items)
                <div class="mb-8">
                    <h1 class="text-2xl font-bold mb-2">{{ $monthYear }}</h1>
                    <hr class="border-t-2 border-tertiary mb-6">
                    <div class="grid grid-cols-12 gap-4">
                        @foreach($items as $item)
                            <a href="{{ route('guest.newsDetail', $item->slug) }}" x-data="{ show: false }"
                                x-init="setTimeout(() => show = true, 300 * {{ $loop->index }})" x-show="show"
                                x-transition:enter="transition ease-out duration-500 transform"
                                x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                                class="block max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm col-span-12 md:col-span-6 lg:col-span-3">
                                <img class="rounded-t-lg object-cover w-full h-[250px] object-top" src="{{ $item->image_url }}"
                                    alt="" />
                                <div class="p-5">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $item->title }}</h5>
                                    <p class="mb-3 font-normal text-gray-700">{{ Str::limit($item->body, 100) }}</p>
                                    <span
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-tertiary rounded-lg hover:bg-secondary hover:text-tertiary focus:ring-4 focus:outline-none focus:ring-blue-300">
                                        Baca lebih lanjut
                                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>