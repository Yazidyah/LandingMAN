<x-app-layout>
<div class="p-4 sm:ml-64">
<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
<div class="container mx-auto pt-5 px-4">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Banner MAN 1 Kota Bogor</h2>
        </div>
    </div>
    <div class="container mx-auto text-center pt-7">
                <h1 class="font-bold text-[32px] pt-7 pb-7 ">Upload Carousel</h1>
                <div class="flex w-3/4 items-center justify-center border-2 border-dasar2 rounded-lg py-2 mx-auto my-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                  </svg>
                <h1 class=" block text-xs lg:text-base items-center text-center justify-center font-semibold">Peringatan : Isi dengan hati hati.</h1>
            </div>

            <form action="{{ url('admin/carousel') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container py-5 mx-auto px-12 lg:px-32 flex items-center justify-center">
        <div class="md:grid grid-cols-4 py-2 w-6/7 gap-2">
            <div class="py-1 flex items-center justify-left">
                <x-reg-input-label class="" for="judul" :value="__('Judul Kegiatan')" />
            </div>
            <div class="py-1 flex items-center justify-left col-span-3">
                <x-reg-input-text id="judulcarousel" class="block mt-1 w-full" type="text" name="judulcarousel" required autofocus autocomplete="judulcarousel" />
                <x-input-error :messages="$errors->get('judulcarousel')" class="mt-2" />
            </div>
            <div class="py-1 flex items-center justify-left">
                <x-reg-input-label class="items-left justify-center flex" for="images" :value="__('Dokumentasi Kegiatan')" />
            </div>
            <div class="py-1 flex items-center justify-left col-span-3">
                <x-reg-input-text id="images" class="block mt-1 w-full" type="file" name="images" required autofocus autocomplete="images" />
                <x-input-error :messages="$errors->get('images')" class="mt-2" />
            </div>
        </div>
    </div>
    <div class="flex items-center justify-center">
        <x-primary-button class="ml-4">
            {{ __('Submit') }}
        </x-primary-button>
    </div>
</form>
</div>
</x-app-layout>



