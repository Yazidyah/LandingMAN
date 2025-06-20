<x-layout>
    <div class="container mx-auto pt-5 px-4 min-h-[85vh]">
        <div class="my-4 bg-tertiary rounded-lg text-white text-center py-8 leading-tight">
            <h2 class="font-bold text-3xl md:text-4xl ">Visi Misi MAN 1 Kota Bogor</h2>
        </div>

        <div class="mx-auto w-1/2 justify-center text-center">
            <div class="mb-4">
            <label for="visi" class="block text-gray-700 text-2xl font-bold mb-2 text-center">Visi:</label>
            <p name="visi" id="visi" rows="6"
                class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-lg ring-2 ring-tertiary">
                {!! nl2br(e($visi->body ?? '')) !!}
            </p>
            </div>
            <div class="mb-4">
            <label for="misi" class="block text-gray-700 text-2xl font-bold mb-2 text-center">Misi:</label>
            <p name="misi" id="misi" rows="6"
                class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-lg ring-2 ring-tertiary">
                {!! nl2br(e($misi->body ?? '')) !!}
            </p>
            </div>
        </div>
    </div>
</x-layout>