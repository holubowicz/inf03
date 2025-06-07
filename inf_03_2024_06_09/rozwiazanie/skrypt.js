const activeImageElement = document.getElementById("active-image");

function showPreviousImage() {
    let imageIndex = Number(activeImageElement.getAttribute("src")[0]) - 1;

    if (imageIndex < 1) {
        imageIndex = 7;
    }

    activeImageElement.setAttribute("src", imageIndex + ".jpg");
}

function showNextImage() {
    let imageIndex = Number(activeImageElement.getAttribute("src")[0]) + 1;

    if (imageIndex > 7) {
        imageIndex = 1;
    }

    activeImageElement.setAttribute("src", imageIndex + ".jpg");
}