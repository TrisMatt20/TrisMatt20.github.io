var previewContainer = document.getElementById("previewContainer");
var imagePreview = document.getElementById("imagePreview");
var imageName = document.getElementById("imageName");
var eventBanner = document.getElementById("eventBanner");

function previewImage() {
    const [file] = eventBanner.files

    if (file) {
        previewContainer.style.display = "block";
        imagePreview.src = URL.createObjectURL(file);
        imageName.innerHTML = file.name;
    } else {
        previewContainer.style.display = "none";
        imagePreview.src = "assets/img/default-img.png";
        imageName.innerHTML = "No image chosen.";
    }
}

function removeImage() {
    eventBanner.value = "";
    imagePreview.src = "assets/img/default-img.png";
    imageName.innerHTML = "No image chosen.";
    previewContainer.style.display = "none";

    if (!eventBanner.hasAttribute("required")) {
        eventBanner.setAttribute("required", true);
    }
}