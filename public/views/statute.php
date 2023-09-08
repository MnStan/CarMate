<?php
$SessionController = new SessionController();
if ($SessionController::isLogged() === false) {
    $SessionController->redirectToLogin();
}
?>

<html lang="en">

<head>
    <?php include('public/views/components/headImports.php'); ?>
    <title>Regulamin</title>
</head>

<body>
    <?php include('public/views/components/navbar.php'); ?>
    <main>
        <div class="container white-text">
            <h2>
                Witamy na stronie internetowej "CarMate" - platformie, która pomaga prywatnym osobom publikować
                ogłoszenia dotyczące wynajmu ich samochodów. Aby zapewnić wszystkim użytkownikom bezpieczne i pozytywne
                doświadczenie, prosimy o przestrzeganie poniższego regulaminu. Korzystając z naszej strony, zgadzasz się
                na spełnienie poniższych warunków i zasad.
            </h2>

            <h3>Rejestracja</h3>
            <ul>
                <li>1.1. Aby korzystać z pełnej funkcjonalności strony "CarMate", musisz założyć konto. Wszystkie
                    informacje podane podczas rejestracji muszą być prawdziwe i aktualne.</li>
                <li>1.2. Użytkownik ponosi pełną odpowiedzialność za swoje konto i jest zobowiązany do zachowania
                    poufności swojego hasła. W przypadku jakiejkolwiek nieautoryzowanej aktywności na koncie, należy
                    niezwłocznie powiadomić naszych administratorów.</li>
            </ul>

            <h3>Publikowanie ogłoszeń</h3>
            <ul>
                <li>2.1. Tylko samochody gotowe do wynajmu mogą być publikowane na stronie "CarMate". Samochody muszą być
                    w dobrym stanie technicznym i zgodne z obowiązującymi przepisami prawnymi.</li>
                <li>2.2. Publikowanie ogłoszeń musi być dokonywane zgodnie z obowiązującymi przepisami prawnymi oraz z
                    uwzględnieniem standardów bezpieczeństwa i jakości.</li>
                <li>2.3. Informacje podane w ogłoszeniach muszą być dokładne i rzetelne. Należy dostarczyć pełne
                    informacje o samochodzie, takie jak marka, model, rok produkcji, stan techniczny, cena wynajmu itp.</li>
                <li>2.4. Nie wolno publikować ogłoszeń, które są nieprawdziwe, obraźliwe, zawierające treści
                    nieodpowiednie lub wprowadzające w błąd.</li>
                <li>2.5. CarMate zastrzega sobie prawo do usunięcia ogłoszeń, które naruszają regulamin lub przepisy
                    prawne. Może również zawiesić lub usunąć konto użytkownika, który systematycznie łamie zasady.</li>
            </ul>

            <h3>Kontakt między użytkownikami</h3>
            <ul>
                <li>3.1. Wszelkie transakcje, negocjacje i interakcje między użytkownikami są ich wyłączną
                    odpowiedzialnością. CarMate nie ponosi odpowiedzialności za ewentualne szkody, straty lub kontrowersje
                    wynikające z takich interakcji.</li>
                <li>3.2. Zalecamy ostrożność podczas nawiązywania kontaktu z innymi użytkownikami. Zawsze należy sprawdzić
                    wiarygodność i uczciwość drugiej strony przed podejmowaniem jakichkolwiek działań.</li>
            </ul>
        </div>
    </main>
    <?php include('public/views/components/footer.php'); ?>
</body>

</html>
