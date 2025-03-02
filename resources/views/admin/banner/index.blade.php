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
            </div>
            <div class="flex justify-end">
                <button onclick="openCreateModal()"
                        class="bg-green-900 text-white px-4 py-2 hover:bg-green-500 rounded">
                        Tambah Banner
                </button>
            </div>
            @foreach ($contents as $content)
                <div name="banner" data-id="{{ $content->id }}"
                    class="relative flex flex-col items-center bg-green-50 p-4 rounded-lg shadow-md mb-2 cursor-pointer transform transition-transform duration-300 hover:scale-95 w-full text-center overflow-visible hover:group">
                    <div class="w-1/4 mb-2">
                        @foreach ($content->images as $image)
                            <div class="bg-gray-200 text-gray-700 p-1 rounded-t-lg">
                                {{ basename($image->image_url, '.' . pathinfo($image->image_url, PATHINFO_EXTENSION)) }}
                            </div>
                            <img src="{{ asset('storage/' . $image->image_url) }}" alt="Deskripsi Gambar"
                                class="rounded-b-lg shadow-md w-full object-cover aspect-video" style="max-height: 150px;">
                        @endforeach
                    </div>
                    <div class="text-center mt-2">
                        <h3 class="font-bold text-lg">{{ $content->title }}</h3>
                    </div>
                    <form action="{{ route('admin.banner.destroy', $content->id) }}" method="POST" class="absolute top-0 right-0 mt-2 mr-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-900 text-white p-2 rounded-full hover:bg-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
    @include('admin.banner.create')
</x-app-layout>