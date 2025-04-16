function populateImages(container, images) {
    images.forEach(image => {
        const imageWrapper = document.createElement("div");
        imageWrapper.classList.add("relative", "group", "w-36", "h-36", "overflow-hidden", "rounded");

        imageWrapper.id = `image-${image.id}`;

        const img = document.createElement("img");
        img.src = `/storage/${image.image_url}`;
        img.alt = "Content Image";
        img.className = "w-full h-full object-cover";

        const deleteButton = document.createElement("button");
        deleteButton.type = "button";
        deleteButton.onclick = () => deleteImage(image.id);
        deleteButton.className =
            "absolute bottom-0 left-0 w-full bg-red bg-opacity-70 text-white text-center py-1 text-xs rounded-b";
        deleteButton.textContent = "Hapus foto ini";

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
