<div id="editModal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full backdrop-blur-sm bg-gray-900 bg-opacity-50 overflow-y-auto"
    onclick="closeModalOnOutsideClick(event)">
    <div class="relative p-4 w-full max-w-2xl" onclick="event.stopPropagation()">
        <div class="relative bg-white rounded-lg shadow-sm">
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">Edit Konten</h3>
                <button type="button" onclick="closeModal()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8">
                    ✕
                </button>
            </div>
            <form id="editForm" class="p-4 md:p-5" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editContentId">
                
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Gambar Konten</label>
                        <div id="editContentImages" class="flex flex-wrap gap-2 mb-4">
                        </div>
                        <input type="file" name="contentFile[]" id="editContentFile" class="border p-2 w-full rounded" multiple>
                    </div>
                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Judul Konten</label>
                        <input type="text" name="title" id="editContentTitle" class="border p-2 w-full rounded" required>
                    </div>
                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                        <textarea name="body" id="editContentBody" class="border p-2 w-full rounded" required></textarea>
                    </div>
                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                        <select name="category_id" id="editCategoryId" class="border p-2 w-full rounded" required>
                            @foreach ($categories as $category)
                                @if (!in_array($category->id, [1, 2]))
                                    <option value="{{ $category->id }}">{{ strtoupper($category->category_name) }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="deleteContent()" class="bg-red-900 hover:bg-red-500 text-white px-4 py-2 rounded mr-2">Delete</button>
                    <button type="submit" class="bg-tertiary hover:bg-secondary text-white hover:text-tertiary px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    #editContentImages img {
        max-width: 200px;
        max-height: 200px;
        object-fit: cover;
    }

    #editContentImages .relative {
        position: relative;
    }

    #editContentImages .relative .absolute {
        position: absolute;
        top: 0;
        right: 0;
        display: none;
    }

    #editContentImages .relative:hover .absolute {
        display: flex;
    }
</style>

<script src="{{ asset('js/content-handler.js') }}"></script>
<script>
    function populateEditModal(content) {
        const elements = getEditModalElements();
        if (!elements) return;

        const { editContentId, editContentTitle, editContentBody, editCategoryId, editForm, editModal, imageContainer } = elements;

        editContentId.value = content.id;
        editContentTitle.value = content.title;
        editContentBody.value = content.body;
        editCategoryId.value = content.category_id;
        editForm.action = `/admin/contents/${content.id}`;

        clearContainer(imageContainer);
        populateImages(imageContainer, content.images);

        editModal.classList.remove('hidden');
    }

    function getEditModalElements() {
        const editContentId = document.getElementById('editContentId');
        const editContentTitle = document.getElementById('editContentTitle');
        const editContentBody = document.getElementById('editContentBody');
        const editCategoryId = document.getElementById('editCategoryId');
        const editForm = document.getElementById('editForm');
        const editModal = document.getElementById('editModal');
        const imageContainer = document.getElementById('editContentImages');

        if (!editContentId || !editContentTitle || !editContentBody || !editCategoryId || !editForm || !editModal || !imageContainer) {
            console.error("Salah satu elemen modal edit tidak ditemukan!");
            return null;
        }

        return { editContentId, editContentTitle, editContentBody, editCategoryId, editForm, editModal, imageContainer };
    }

    function clearContainer(container) {
        while (container.firstChild) {
            container.removeChild(container.firstChild);
        }
    }

    function populateImages(container, images) {
        images.forEach(image => {
            const imgElement = document.createElement('img');
            imgElement.src = image.url;
            imgElement.alt = image.alt || 'Content Image';
            container.appendChild(imgElement);
        });
    }

    function deleteContent() {
        if (confirm('Are you sure you want to delete this content?')) {
            const form = document.getElementById('editForm');
            form._method.value = 'DELETE';
            form.submit();
        }
    }

    function closeModalOnOutsideClick(event) {
        const modal = document.getElementById('editModal');
        if (event.target === modal) {
            closeModal();
        }
    }

    function closeModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
    }
</script>
</body>
</html>
