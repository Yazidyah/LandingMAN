function populateImages(container, images) {
    images.forEach(image => {
        const imageWrapper = document.createElement("div");
        imageWrapper.classList.add("relative", "group");
        imageWrapper.id = `image-${image.id}`;

        const img = document.createElement("img");
        img.src = `/storage/${image.image_url}`;
        img.alt = "Content Image";
        img.className = "w-36 h-36 object-cover rounded";

        const deleteButton = document.createElement("button");
        deleteButton.type = "button";
        deleteButton.onclick = () => deleteImage(image.id);
        deleteButton.className =
            "absolute top-0 right-0 bg-black-400 text-white rounded-full w-6 h-6 flex items-center justify-center";
        deleteButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        `;

        imageWrapper.appendChild(img);
        imageWrapper.appendChild(deleteButton);
        container.appendChild(imageWrapper);
    });
}

function deleteImage(imageId) {
    if (!confirm("Apakah Anda yakin ingin menghapus gambar ini?")) return;

    fetch(`/admin/contents/images/${imageId}`, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector(`#image-${imageId}`).remove();
        } else {
            console.error(data.error || "Failed to delete image");
        }
    })
    .catch(error => console.error("Error:", error));
}
