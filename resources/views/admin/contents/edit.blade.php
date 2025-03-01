<div id="editModal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full backdrop-blur-sm bg-gray-900 bg-opacity-50 overflow-y-auto">
    <div class="relative p-4 w-full max-w-2xl">
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
                        <div id="editContentImages" class="flex flex-wrap gap-2 mb-4"></div>
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
                                <option value="{{ $category->id }}">{{ strtoupper($category->category_name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="deleteContent()" class="bg-red-600 text-white px-4 py-2 rounded">Delete</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function deleteContent() {
        if (confirm('Are you sure you want to delete this content?')) {
            const form = document.getElementById('editForm');
            form._method.value = 'DELETE';
            form.submit();
        }
    }
</script>
</body>
</html>
