function loadBanner(event) {
    var image = document.getElementById('banner');
    image.src = URL.createObjectURL(event.target.files[0]);
    image.onload = function () {
        URL.revokeObjectURL(image.src); // Libera o recurso
    }
}

function loadPhoto(event) {
    var image = document.getElementById('photo');
    image.src = URL.createObjectURL(event.target.files[0]);
    image.onload = function () {
        URL.revokeObjectURL(image.src); // Libera o recurso
    }
}