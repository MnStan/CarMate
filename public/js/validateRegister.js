function validateRegisterForm() {
    const nameInput = document.querySelector('input[name="name"]');
    const surnameInput = document.querySelector('input[name="surname"]');
    const emailInput = document.querySelector('input[name="email"]');
    const phoneNumberInput = document.querySelector('input[name="phoneNumber"]');
    const addressInput = document.querySelector('input[name="adress"]'); 

    // Sprawdzenie, czy pola są wypełnione
    if (!nameInput.value || !surnameInput.value || !emailInput.value || !phoneNumberInput.value || !addressInput.value) {
        alert("Proszę wypełnić wszystkie pola.");
        return false;
    }

    // Walidacja adresu e-mail
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!emailRegex.test(emailInput.value)) {
        alert("Proszę wprowadzić poprawny adres e-mail.");
        return false;
    }

    const phoneRegex = /^[0-9]{9}$/;
    if (!phoneRegex.test(phoneNumberInput.value)) {
        alert("Proszę wprowadzić poprawny numer telefonu (dokładnie 9 cyfr).");
        return false;
    }

    // Walidacja długości adresu (co najmniej 5 znaków)
    if (addressInput.value.length < 5) {
        alert("Adres jest zbyt krótki. Proszę wprowadzić dłuższy adres.");
        return false;
    }

    // Jeśli wszystkie walidacje zakończą się sukcesem, formularz jest prawidłowy
    console.log("Formularz został przesłany i jest prawidłowo walidowany.");
    return true;
}
