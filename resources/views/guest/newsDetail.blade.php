<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/flickity.css" rel="stylesheet" media="screen">
    <link href="logoman.png" type="image/png" rel="icon">
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>MAN 1 KOTA BOGOR</title>
</head>

<body>


    <main>
        <div class="container mx-auto pt-5 px-4 my-10">
                <a href="/news" class="flex justify-center bg-tertiary hover:bg-secondary hover:text-tertiary text-white font-bold py-3 px-6 rounded focus:outline-none focus:shadow-outline text-lg">BACK TO HOME</a>
    <div class="my-4 text-left gap-4 leading-tight flex justify-center items-center flex-col">
        <h2 class="font-bold text-3xl md:text-4xl">{{ $news->title }}</h2>
        <h2 class=" text-xl ">Diterbitkan Pada: {{($news->created_at)->isoFormat('dddd, D MMMM YYYY')}}</h2>
    </div>
    <div id="gallery" class="block w-full max-w-3xl mx-auto" data-carousel="slide" style="z-index: 1;">
        <!-- Carousel wrapper -->
        <div class="relative pb-[75%] overflow-hidden rounded-lg">
            @foreach($news->images as $index => $image)
            <div class="hidden duration-700 ease-in-out" data-carousel-item="{{ $index === 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $image->image_url) }}" class="absolute block w-full object-cover" alt="">
            </div>
            @endforeach
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
        <div class="mt-4 text-gray-700 text-lg">
        Admin MAN 1 Kota Bogor
    </div>
    <div class="mt-4 text-gray-700 text-lg">
        {!! nl2br(e($news->body)) !!}
    </div>
    </div>

    

    
</div>

        <x-javascript></x-javascript>
    </main>
    
</body>

</html>

