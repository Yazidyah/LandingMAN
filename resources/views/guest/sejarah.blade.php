<x-layout>
<div class="container mx-auto pt-5 px-4 min-h-[85vh]">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Sejarah MAN 1 Kota Bogor</h2>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-gray-800 prose max-w-none">
            {{-- Jika body mengandung HTML, gunakan {!! $sejarah->body ?? '' !!} --}}
            {{-- Jika hanya teks biasa, gunakan nl2br agar baris baru tampil --}}
            {!! isset($sejarah->body) ? (trim($sejarah->body) === strip_tags($sejarah->body) ? nl2br(e($sejarah->body)) : $sejarah->body) : '' !!}
        </div>
    </div>
</x-layout>