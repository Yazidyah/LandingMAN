<x-layout>
<div class="container mx-auto pt-5 px-4 min-h-[90vh]">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Selamat Datang di Website Fasilitas MAN 1 Kota Bogor</h2>
        </div>

        @if($news->isNotEmpty())
        <div class="my-8 grid grid-cols-12 gap-4">
        @foreach($news as $item)
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm col-span-12 md:col-span-6 lg:col-span-4">
                <img class="rounded-t-lg" src="{{ $item->image_url }}" alt="" />
            <div class="p-5">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $item->title }}</h5>
            </div>
        </div>
        @endforeach
        @else
            <p class="text-center text-gray-500">Tidak ada Fasilitas  yang tersedia.</p>
        @endif
    </div>
    </div>
    </x-layout>