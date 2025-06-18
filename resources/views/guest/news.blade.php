<x-layout>
    <div class="container mx-auto pt-5 px-4 min-h-[85vh]">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl">Berita MAN 1 Kota Bogor</h2>
        </div>
        {{-- Search form --}}
        <div class="flex justify-end mb-6">
            <form method="GET" action="{{ route('guest.news') }}" class="flex w-full max-w-md">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul berita..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-l focus:outline-none focus:ring-2 focus:ring-tertiary">
                <button type="submit"
                    class="px-4 py-2 bg-tertiary text-white rounded-r hover:bg-secondary transition flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
            </form>
        </div>
        @if($news->isNotEmpty())
        <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)" x-show="show"
            x-transition:enter="transition-opacity duration-500" x-transition:enter-start="opacity-0"
            x-transition:enter-end= "opacity-100" class="my-12 grid grid-cols-12 gap-4 bg-white">
             
            @foreach($news as $item)
                <a href="{{ route('guest.newsDetail', $item->slug) }}" x-data="{ show: false }"
                    x-init="setTimeout(() => show = true, 300 * {{ $loop->index }})" x-show="show"
                    x-transition:enter="transition ease-out duration-500 transform"
                    x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                    class="block max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm col-span-12 md:col-span-6 lg:col-span-3">
                    <img class="rounded-t-lg object-cover w-full h-[250px] object-top" src="{{ $item->image_url }}"
                        alt="" />
                    <div class="p-5">
                        <div>
                            <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 leading-snug">
                                {{ $item->title }}
                            </h5>
                        </div>
                        <p class="font-normal text-sm text-gray-400">Admin</p>
                        <p class="mb-3 font-normal text-sm text-gray-700">{{ Str::limit($item->body, 100) }}</p>
                        <p class="mb-3 font-normal text-sm text-gray-700">{{ $item->formatted_date }}</p>
                        <div
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-tertiary rounded-lg hover:bg-secondary hover:text-tertiary focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Klik untuk membaca lebih lanjut
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
            @else
            <p class="text-center text-gray-500">Tidak ada berita yang tersedia.</p>
        @endif
        </div>
</div>
</x-layout>