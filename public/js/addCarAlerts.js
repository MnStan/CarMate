function validateAddCarForm() {
        const avatarInput = document.querySelector('input[name="avatar"]');
        const titleInput = document.querySelector('input[name="title"]');
        const citySelect = document.querySelector('select[name="city"]');
        const descriptionTextarea = document.querySelector('textarea[name="description"]');

        console.log(citySelect)

        if (!avatarInput.files.length || !titleInput.value || !citySelect.value || !descriptionTextarea.value) {
            alert("Proszę wypełnić wszystkie wymagane pola i dodać zdjęcie.");
            return false;
        }

        return true;
    }