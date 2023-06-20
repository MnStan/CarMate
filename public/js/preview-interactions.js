const carInput = document.getElementById('car-input');
const carPreview = document.getElementById('car-preview');
const avatarButton = document.querySelector(".custom-car-input button");

avatarButton.addEventListener("click", function(event) {
    event.preventDefault();
    carInput.click();
});

carInput.addEventListener('change', () => {
    const file = carInput.files[0];
    const reader = new FileReader();

    reader.onload = function(event) {
        carPreview.setAttribute('src', event.target.result);
        carPreview.style.display = 'block';
    }

    reader.readAsDataURL(file);
});