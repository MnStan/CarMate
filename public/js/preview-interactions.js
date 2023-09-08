const carInput = document.getElementById('car-input');
const carPreview = document.getElementById('car-preview');
const avatarButton = document.querySelector(".custom-car-input button");

avatarButton.addEventListener("click", function(event) {
    event.preventDefault();
    carInput.click();
});

carInput.addEventListener('change', () => {
    while (carPreview.firstChild) {
        carPreview.removeChild(carPreview.firstChild);
    }

    const files = carInput.files;

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function(event) {
            const image = document.createElement('img');
            image.src = event.target.result;
            carPreview.appendChild(image);
        }

        reader.readAsDataURL(file);
    }

    carPreview.style.display = 'block';
});

const carInputPhotos = document.getElementById('car-input-photos');
const carPreviewPhotos = document.getElementById('car-preview-photos');
const avatarButtonPhotos = document.querySelector(".custom-car-input-photos button");

avatarButtonPhotos.addEventListener("click", function(event) {
    event.preventDefault();
    carInputPhotos.click();
});

carInputPhotos.addEventListener('change', () => {
    while (carPreviewPhotos.firstChild) {
        carPreviewPhotos.removeChild(carPreviewPhotos.firstChild);
    }

    const files = carInputPhotos.files;

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function(event) {
            const image = document.createElement('img');
            image.src = event.target.result;
            carPreviewPhotos.appendChild(image);
        }

        reader.readAsDataURL(file);
    }

    carPreviewPhotos.style.display = 'block';
});
