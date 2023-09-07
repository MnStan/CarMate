<?php

require_once "public/views/components/rentInfoBean.php";
require_once "public/views/components/card.php";
require_once "public/views/components/button.php";
require_once "public/views/components/form.php";
require_once "public/views/components/input.php";

$SessionController = new SessionController();
$userIsAuthenticated = $SessionController::isLogged();

if ($SessionController::isLogged() === false) {
    $SessionController->redirectToLogin();
}

$Repository = new Repository;
$cities = $Repository->getAllCities();

$addButtonArray = [
    'value' => 'Dodaj obrazek'
];

$buttonArrayCarInfo = [
    'type' => 'submit',
    'value' => 'dodaj'
];


$addCarAndPreview = '
<label for="car-input" class="custom-car-input">
    ' . Button($addButtonArray) . '
</label>
<input type="file" name="avatar" accept=".jpg, .jpeg" id="car-input" multiple>
<div id="car-preview" class="car-preview" style="display: none;"></div>
';


$inputName = '
    <input class="input input-text-primary" type="text" name="title" placeholder="Podaj nazwę pojazdu"
';

$selectCity = '<div class="input-container"><div class="custom-select">
                <select name="city" required>';
$selectCity .= '<option value="" disabled selected>Wybierz miasto</option>';
foreach ($cities as $city) {
    $selectCity .= '<option value="' . $city[0] . '">' . $city[1] . '</option>';
}
$selectCity .= '</select>
            </div></div>';

$addDescription = '
    <textarea class="textarea" name="description" id="" cols="30" rows="10"
    placeholder="Dodaj opis"></textarea>
';
            

$formContent = [
    'action' => 'addCarForm',
    'method' => 'POST',
    'content' => $addCarAndPreview . $inputName . $selectCity . $addDescription . Button($buttonArrayCarInfo)
];


?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <title>Informacje</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <div class="login-error-message">
                        <?php echo $messages['error']; ?>
                    </div>
    <main class="container flex flex-center flex-column" style="gap: 1.5rem">
        <div class="car-photo-container">
            <?php echo Form($formContent, null); ?>
        </div>
    </main>
</body>

</html>
