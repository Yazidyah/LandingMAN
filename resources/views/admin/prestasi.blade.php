<x-app-layout>
<div class="p-4 sm:ml-64">
<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
<div class="container mx-auto pt-5 px-4">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Tambah Prestasi MAN 1 Kota Bogor</h2>
        </div>
    </div>
    <div class="container mx-auto text-center pt-7">
                <h1 class="font-bold text-[32px] pt-7 pb-7 ">Upload Prestasi</h1>
                <div class="flex w-3/4 items-center justify-center border-2 border-dasar2 rounded-lg py-2 mx-auto my-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                  </svg>
                <h1 class=" block text-xs lg:text-base items-center text-center justify-center font-semibold">Peringatan : Isi Prestasi dengan data yang benar.</h1>
            </div>

            <form action="{{url('admin/upload/prestasi')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="container py-5 mx-auto px-12 lg:px-32 flex items-center justify-center">
            <div class="md:grid grid-cols-4  py-2 w-6/7 gap-2">
                
                <div class ="py-1 flex items-center justify-left">
                    <x-reg-input-label class="" for="judul" :value="__('Nama Kegiatan')" />
                </div>
                <div class ="py-1 flex items-center justify-left col-span-3">
                    <x-reg-input-text id="kegiatan" class=" block mt-1 w-full" type="text" name="kegiatan" required autofocus autocomplete="kegiatan" placeholder="Misal : Kompra 2024" />
                    <x-input-error :messages="$errors->get('kegiatan')" class="mt-2" />
                </div>

                <div class ="py-1 flex items-center justify-left">
                    <x-reg-input-label class="" for="tanggalkeg" :value="__('Tanggal Kegiatan')" />
                </div>    
                <div class ="py-1 flex items-center justify-left col-span-3">
                    <x-reg-input-text id="tanggalkeg" class=" block mt-1 w-full" type="date" name="tanggalkeg" required autofocus autocomplete="tanggalkeg" value=""/>
                    <x-input-error :messages="$errors->get('tanggalkeg')" class="mt-2" />
                </div>

                <div class ="py-1 flex items-center justify-left">
                    <x-reg-input-label class="" for="tempat" :value="__('Tempat')" />
                </div>
                <div class ="py-1 flex items-center justify-left col-span-3">
                    <x-reg-input-text id="tempatkeg" class=" block mt-1 w-full" type="text" name="tempatkeg" required autofocus autocomplete="tempatkeg" placeholder="Isi instansi penyelenggara"/>
                    <x-input-error :messages="$errors->get('tempatkeg')" class="mt-2" />
                </div>
                <div class ="py-1 flex items-center justify-left">
                    <x-reg-input-label class="" for="tingkat" :value="__('Tingkat')" />
                </div>
                <div class ="py-1 flex items-center justify-left col-span-3">
                    <x-reg-input-text id="tingkat" class=" block mt-1 w-full" type="text" name="tingkat" required autofocus autocomplete="tingkat" placeholder="Misal : Tingkat Nasional"/>
                    <x-input-error :messages="$errors->get('tingkat')" class="mt-2" />
                </div>

                <div class ="py-1 flex items-center justify-left">
                    <x-reg-input-label class="" for="tahunkeg" :value="__('Tahun Kegiatan')" />
                </div>
                <div class ="py-1 flex items-center justify-left col-span-3">
                    <x-reg-input-text id="tahunkeg" class=" block mt-1 w-full" type="text" name="tahunkeg" required autofocus autocomplete="tahunkeg" placeholder="Misal : 2020" />
                    <x-input-error :messages="$errors->get('tahunkeg')" class="mt-2" />
                </div>

                <div class ="py-1 flex items-center justify-left">
                    <x-reg-input-label class="" for="juara" :value="__('Juara')" />
                </div>
                <div class ="py-1 flex items-center justify-left col-span-3">
                    <x-reg-input-text id="juara" class=" block mt-1 w-full" type="text" name="juara" required autofocus autocomplete="juara" placeholder="Misal : Juara 1"/>
                    <x-input-error :messages="$errors->get('juara')" class="mt-2" />
                </div>

                <div class ="py-1 flex items-center justify-left">
                    <x-reg-input-label class="" for="kategori" :value="__('Kategori')" />
                </div>
                <div class ="py-1 flex items-center justify-left col-span-3">
                    <x-reg-input-text id="kategori" class=" block mt-1 w-full" type="text" name="kategori" required autofocus autocomplete="kategori" placeholder="Misal : Dasvakot"/>
                    <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                </div>

               

                
        </div>
        </div>
        <x-primary-button class="mb-2 mx-auto" value="Tambah Kegiatan">
                {{ __('Submit') }}
            </x-primary-button>
    </form>
</div>
</x-app-layout>



