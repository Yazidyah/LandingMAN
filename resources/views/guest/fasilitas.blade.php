<x-layout>
<div class="container mx-auto pt-5 px-4">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Selamat Datang di Website Fasilitas MAN 1 Kota Bogor</h2>
        </div>

        <div class="mt-8 grid grid-cols-12 gap-4">
        @foreach($news as $item)
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm col-span-12 md:col-span-6 lg:col-span-4">
            <a href="{{ route('guest.newsDetail', $item->slug) }}">
                <img class="rounded-t-lg" src="{{ $item->image_url }}" alt="" />
            </a>
            <div class="p-5">
                <a href="{{ route('guest.newsDetail', $item->slug) }}">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $item->title }}</h5>
                </a>
                
            </div>
        </div>
        @endforeach
    </div>
    </div>
    </x-layout>