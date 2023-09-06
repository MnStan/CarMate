const carInput = document.getElementById('car-input');
const carPreview = document.getElementById('car-preview');
const avatarButton = document.querySelector(".custom-car-input button");

avatarButton.addEventListener("click", function(event) {
    event.preventDefault();
    carInput.click();
});

carInput.addEventListener('change', () => {
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


// Pobieranie wszystkich elementów z klasą 'editable'
const editableElements = document.querySelectorAll('.editable');

// Dodanie nasłuchiwacza kliknięcia dla każdego edytowalnego elementu
editableElements.forEach(editableElement => {
  editableElement.addEventListener('click', () => {
    const currentValue = editableElement.innerText;

    const inputField = document.createElement('input');
    inputField.type = 'text';
    inputField.value = currentValue;

    editableElement.innerHTML = '';
    editableElement.appendChild(inputField);

    inputField.focus();

    const saveChanges = () => {
      const newValue = inputField.value;

      editableElement.innerHTML = newValue;

      inputField.removeEventListener('blur', saveChanges);
    };

    inputField.addEventListener('blur', saveChanges);
  });
});


