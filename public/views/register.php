<?php

require_once "public/views/components/input.php";
require_once "public/views/components/form.php";
require_once "public/views/components/card.php";
require_once "public/views/components/button.php";

$SessionController = new SessionController();
if ($SessionController::isLogged()) {
    $SessionController->redirectToHome();
}

$Repository = new Repository;
$cities = $Repository->getAllCities();

$inputName = [
    'type' => 'name',
    'name' => 'nickname',
    'placeholder' => 'Imię',
    'value' => $messages['name'],
    'image' => 'public/img/input/user-regular.svg',
];

$inputSurame = [
    'type' => 'name',
    'name' => 'surname',
    'placeholder' => 'Nazwisko',
    'value' => $messages['surname'],
    'image' => 'public/img/input/user-regular.svg',
];

$inputEmail = [
    'type' => 'name',
    'name' => 'email',
    'placeholder' => 'email',
    'value' => $messages['email'],
    'image' => 'public/img/input/envelope-regular.svg',
];

$inputPassword = [
    'type' => 'password',
    'name' => 'password',
    'placeholder' => 'hasło',
    'image' => 'public/img/input/lock-solid.svg',
];

$inputPhone = [
    'type' => 'tel',
    'name' => 'phoneNumber',
    'placeholder' => 'Numer telefonu',
    'image' => 'public/img/input/phone-solid.svg',
];

$inputAdress = [
    'type' => 'adress',
    'name' => 'adress',
    'placeholder' => 'Podaj adres',
    'image' => 'public/img/input/location-dot-solid.svg',
];

$buttonArray = [
    'type' => 'submit',
    'value' => 'zarejestruj'
];

$selectCity = '<div class="input-container"><div class="custom-select">
                <select name="city" required>
                    <option value="">Wybierz miasto</option>';
foreach ($cities as $city) {
    $selectCity .= '<option value="' . $city[0] . '">' . $city[1] . '</option>';
}
$selectCity .= '</select>
            </div></div>';

$formContent = [
    'action' => 'checkRegister',
    'method' => 'POST',
    'content' => Input($inputName) . Input($inputSurame) . Input($inputEmail) . Input($inputPassword) . Input($inputPhone) . $selectCity . Input($inputAdress) . Button($buttonArray)
];

$onSubmitFunction = 'validateRegisterForm';

$cardContent = Form($formContent, $onSubmitFunction);

$cardArray = [
    'title' => 'Rejestracja',
    'content' => $cardContent 
];

?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <title>Login</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <main class="login-container container flex flex-center flex-column">
        <?php echo Card($cardArray); ?>
    </main>
</body>
</html>