<x-layout>
<div class="container mx-auto pt-5 px-4">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Selamat Datang di Website MAN 1 Kota Bogor</h2>
        </div>
    </div>
    <div class="mx-auto items-center pb-10 mt-10 justify-center w-3/4" data-flickity>
    @foreach ($contents as $content)
                        @foreach ($content->images as $image)
                            <img src="{{ asset('storage/' . $image->image_url) }}" alt="Deskripsi Gambar"
                                class="rounded-b-lg shadow-md w-max-full object-cover aspect-video" style="max-height: 150px;">
                        @endforeach
            @endforeach
        </div>

        </x-layout>