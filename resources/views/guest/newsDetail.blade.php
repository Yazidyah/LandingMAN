<x-layout>
    <div class="container mx-auto px-4 my-10">
        <div class="my-4 text-left gap-2 leading-tight flex justify-center items-center flex-col">
            <h2 class="font-bold text-3xl md:text-4xl">{{ $news->title }}</h2>
            <p class="text-sm">Diterbitkan Pada: {{ $news->formatted_date }}</p>
        </div>
        <div id="gallery" class="block w-full max-w-3xl mx-auto p-2" data-carousel="slide">
            <!-- Carousel wrapper with relative positioning -->
            <div class="relative overflow-hidden rounded-lg ">
                <!-- Images container -->
                <div class="relative pb-[75%]">
                    @foreach($news->images as $index => $image)
                        <div class="absolute inset-0 w-full h-full flex items-center justify-center hidden duration-700 ease-in-out"
                            data-carousel-item="{{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image->image_url) }}"
                                class="block w-full h-full object-contain max-h-[700px]" alt="">
                        </div>
                    @endforeach
                </div>
                <div class="absolute top-0 left-0 z-50 flex items-center justify-between w-full h-full">
                    <button type="button"
                        class="h-24 w-1/5 flex items-center justify-right cursor-pointer focus:outline-none pl-2"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <div class="h-full w-3/5"></div>
                    <button type="button"
                        class="h-24 w-1/5 flex items-center justify-end cursor-pointer focus:outline-none pr-2"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
            </div>

            <div class="mt-4 text-gray-700 text-lg">
                Admin MAN 1 Kota Bogor
            </div>
            <div class="mt-4 text-gray-700 text-lg">
                {!! nl2br($news->body) !!}
            </div>
        </div>
        <div class="mt-10 flex justify-center">
            <a href="/news" class="bg-tertiary hover:bg-secondary hover:text-tertiary text-white font-bold py-3 px-6 rounded focus:outline-none focus:shadow-outline text-lg">
                Lihat lainnya
            </a>
        </div>
    </div>
</x-layout>
