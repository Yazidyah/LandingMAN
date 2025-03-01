<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">
                <h1 class="font-bold text-[32px] pt-7 pb-7 ">Posting Kegiatan</h1>
                <div class="flex w-3/4 items-center justify-center border-2 border-dasar2 rounded-lg py-2 mx-auto my-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    <h1 class=" block text-xs lg:text-base items-center text-center justify-center font-semibold">
                        Peringatan : Isi Kegiatan dengan data yang benar.</h1>
                </div>
                <div class="flex justify-end">
                <button onclick="openCreateModal()" class="bg-green-900 text-white px-4 py-2 hover:bg-green-500 rounded">
                    Buat Postingan
                </button>
            </div>
                <!-- Ini untuk memunculkan konten yang di db meenggunakan foreach -->
                @foreach ($contents as $content)
                    <div name="konten" class="flex bg-green-50 p-4 rounded-lg shadow-md mb-2 cursor-pointer transform transition-transform duration-300 hover:scale-105" onclick="openEditModal({{ $content->id }})">
                        <!-- Gambar di kiri -->
                        <div class="w-1/4 pr-2">
                            @if ($content->images->isNotEmpty())
                                <img src="{{ $content->image_url }}" alt="Deskripsi Gambar"
                                    class="rounded-lg shadow-md w-full mb-2 object-cover aspect-square max-w-[100px]">
                            @endif
                        </div>
                        <!-- Konten di kanan -->
                        <div class="w-3/4 flex flex-col justify-start pl-2">
                            <!-- Label kategori -->
                            <div class="mb-1 text-left">
                                <span class="{{ $content->category_color }} text-xs font-semibold px-2 py-1 rounded uppercase">
                                    {{ $content->category->category_name }}
                                </span>
                            </div>

                            <!-- Judul -->
                            <h2 class="text-lg font-bold text-blue-700 leading-tight text-left">
                                {{ Str::limit($content->title, 50) }}
                            </h2>

                            <!-- Deskripsi -->
                            <p class="text-sm text-gray-900 mt-1 leading-relaxed text-left">
                                {{ Str::limit($content->body, 100) }}
                            </p>

                            <!-- Tanggal diupload -->
                            <div class="mt-2 text-gray-600 text-xs flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 7V3M16 7V3M3 11h18M5 21h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                {{ $content->created_at->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

@include('admin.contents.edit')
@include('admin.contents.create')

<script>
function openEditModal(contentId) {
    // Ambil data konten dari daftar yang sudah ada di halaman
    let content = @json($contents).find(c => c.id == contentId);

    if (content) {
        document.getElementById('editContentId').value = content.id;
        document.getElementById('editContentTitle').value = content.title;
        document.getElementById('editContentBody').value = content.body;
        document.getElementById('editCategoryId').value = content.category_id;

        // Update form action untuk mengarah ke konten yang benar
        document.getElementById('editForm').action = `/admin/contents/${content.id}`;

        // Tampilkan modal
        document.getElementById('editModal').classList.remove('hidden');
    }
}

function closeModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('createModal').classList.add('hidden');
}

function openCreateModal() {
    // Reset form create
    document.getElementById('createForm').reset();

    // Tampilkan modal create
    document.getElementById('createModal').classList.remove('hidden');
}
</script>