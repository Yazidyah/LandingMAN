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
                        <ul id="editFileList" class="mt-2 text-sm text-gray-600"></ul>
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
    #editContentImages {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    #editContentImages img {
        max-width: 300px;
        height: 100%;
        object-fit: cover;
        border-radius: 0.5rem;
    }

    #editContentImages .relative {
        position: relative;
        max-width: 300px;
        height: 100%;
        overflow: hidden;
        border-radius: 0.5rem;
    }

    #editContentImages .relative button {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: rgba(255, 0, 0, 0.7);
        color: white;
        padding: 0.25rem 0;
        font-size: 0.75rem;
        border-radius: 0 0 0.5rem 0.5rem;
        text-align: center;
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

    const editFileInput = document.getElementById('editContentFile');
    const editFileList = document.getElementById('editFileList');
    let editDataTransfer = new DataTransfer();

    editFileInput.addEventListener('change', (event) => {
        const newFiles = Array.from(event.target.files);

        // Add new files to DataTransfer
        newFiles.forEach(file => {
            editDataTransfer.items.add(file);
        });

        // Update the file input with the new DataTransfer files
        editFileInput.files = editDataTransfer.files;

        // Update the file list UI
        updateEditFileListUI();
    });

    function updateEditFileListUI() {
        editFileList.innerHTML = '';

        Array.from(editDataTransfer.files).forEach((file, index) => {
            const li = document.createElement('li');
            li.classList.add('flex', 'items-center', 'justify-between', 'mb-1');

            const fileName = document.createElement('span');
            fileName.textContent = file.name;

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.textContent = 'Hapus';
            removeButton.classList.add('bg-red-500', 'text-white', 'px-2', 'py-1', 'rounded', 'text-xs');
            removeButton.addEventListener('click', () => removeEditFile(index));

            li.appendChild(fileName);
            li.appendChild(removeButton);
            editFileList.appendChild(li);
        });
    }

    function removeEditFile(index) {
        const newDataTransfer = new DataTransfer();

        Array.from(editDataTransfer.files).forEach((file, idx) => {
            if (idx !== index) {
                newDataTransfer.items.add(file);
            }
        });

        editDataTransfer = newDataTransfer;
        editFileInput.files = editDataTransfer.files;

        updateEditFileListUI();
    }
</script>
</body>
</html>
