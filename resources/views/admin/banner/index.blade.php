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
                    class="bg-tertiary text-white px-4 py-2 hover:text-tertiary hover:bg-secondary rounded">
                    Tambah Banner
                </button>
            </div>
            @foreach ($contents as $content)
                <div name="banner" data-id="{{ $content->id }}"
                    class="mt-2 relative flex flex-col items-center bg-green-50 p-4 rounded-lg shadow-md mb-2 cursor-pointer transition-colors duration-300 hover:bg-green-300 w-full text-center overflow-visible hover:group"
                    onclick="openPreviewModal({{ $content->id }})">
                    <div class="w-1/4 mb-2">
                        @foreach ($content->images as $image)
                            <img src="{{ asset('storage/' . $image->image_url) }}" alt="Banner"
                                class="rounded-b-lg shadow-md w-full object-cover aspect-video" style="max-height: 150px;">
                            <div class="bg-gray-200 text-gray-700 p-1 rounded-t-lg">
                                Diupload pada {{ $image->formatted_date }}
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-2">
                        <h3 class="font-bold text-lg">{{ $content->title }}</h3>
                    </div>
                    <form action="{{ route('admin.banner.destroy', $content->id) }}" method="POST"
                        class="absolute top-0 right-0 mt-2 mr-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-900 text-white p-2 rounded-full hover:bg-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd"
                                    d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
    @include('admin.banner.create')

    <!-- Modal for previewing images -->
    <div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
        onclick="closeModalOnOutsideClick(event)">
        <div class="bg-white rounded-lg p-4 w-3/4 max-h-[80%] overflow-y-auto relative"
            onclick="event.stopPropagation()">
            <button onclick="closePreviewModal()"
                class="absolute top-2 right-2 bg-red-900 text-white p-2 rounded-full hover:bg-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
            <div id="modalContent" class="flex flex-wrap justify-center gap-4">
                <!-- Images will be dynamically inserted here -->
            </div>
        </div>
    </div>

    <script>
        function openPreviewModal(contentId) {
            const modal = document.getElementById('previewModal');
            const modalContent = document.getElementById('modalContent');
            modalContent.innerHTML = ''; // Clear previous content

            // Fetch images for the selected content
            const content = @json($contents);
            const selectedContent = content.find(c => c.id === contentId);

            if (selectedContent && selectedContent.images) {
                selectedContent.images.forEach(image => {
                    const imgElement = document.createElement('img');
                    imgElement.src = `{{ asset('storage') }}/${image.image_url}`;
                    imgElement.alt = 'Banner Image';
                    imgElement.className = 'rounded-lg shadow-md max-h-[90vh] w-auto object-contain';
                    modalContent.appendChild(imgElement);
                });
            }

            modal.classList.remove('hidden');
        }

        function closePreviewModal() {
            const modal = document.getElementById('previewModal');
            modal.classList.add('hidden');
        }

        function closeModalOnOutsideClick(event) {
            const modal = document.getElementById('previewModal');
            if (event.target === modal) {
                closePreviewModal();
            }
        }
    </script>
</x-app-layout>