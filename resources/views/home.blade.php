<x-layout>
<div class="container mx-auto pt-5 px-4">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Selamat Datang di Website MAN 1 Kota Bogor</h2>
        </div>
    
    <div class="mx-auto items-center pb-10 mt-10 justify-center w-full" data-flickity>
    @foreach ($contents as $content)
                        @foreach ($content->images as $image)
                            <img src="{{ asset('storage/' . $image->image_url) }}" alt="Deskripsi Gambar"
                                class="rounded-b-lg w-max-full object-cover aspect-video ">
                        @endforeach
            @endforeach
        </div>

        <div class="my-6 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Berita Sekolah</h2>
        </div>
        <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)" x-show="show"
    x-transition:enter="transition-opacity duration-500"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    class="my-12 grid grid-cols-12 gap-4 bg-white">
    
    @foreach($news as $item)
    <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 300 * {{ $loop->index }})"
        x-show="show"
        x-transition:enter="transition ease-out duration-500 transform"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm col-span-12 md:col-span-6 lg:col-span-3">
        
        <a href="{{ route('guest.newsDetail', $item->slug) }}">
            <img class="rounded-t-lg" src="{{ $item->image_url }}" alt="" />
        </a>
        <div class="p-5">
            <a href="{{ route('guest.newsDetail', $item->slug) }}">
                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900">{{ $item->title }}</h5>
            </a>
            <p class="font-normal text-sm text-gray-400">Admin</p>
            <p class="mb-3 font-normal text-sm text-gray-700">{{ Str::limit($item->body, 100) }}</p>
            <p class="mb-3 font-normal text-sm text-gray-700">{{ ($item->created_at)->isoFormat('dddd, D MMMM YYYY') }}</p>
            <a href="{{ route('guest.newsDetail', $item->slug) }}"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-tertiary rounded-lg hover:bg-secondary hover:text-tertiary focus:ring-4 focus:outline-none focus:ring-blue-300">
                Baca lebih lanjut
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
    </div>
    @endforeach
</div>
    </div>
        </x-layout>