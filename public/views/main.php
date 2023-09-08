<?php

require_once "public/views/components/input.php";
require_once "public/views/components/form.php";
require_once "public/views/components/card.php";
require_once "public/views/components/carCard.php";
require_once "public/views/components/button.php";

$SessionController = new SessionController();
$userIsAuthenticated = $SessionController::isLogged();

if ($SessionController::isLogged() === false) {
    $SessionController->redirectToHome();
}

$carController = new CarController();
$cars = $carController->getCars(1);

$searchInput = [
    'type' => 'text',
    'name' => 'search',
    'placeholder' => 'Marka, Model',
    'image' => 'public/img/input/lock-solid.svg',
];

$formContent = [
    'action' => 'checkLogin',
    'method' => 'POST',
    'content' => Input($searchInput)
];

$cardContent = Form($formContent, null);

$cardArray = [
    'title' => 'Znajdź samochód dla siebie',
    'content' => $cardContent
];

?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <title>Główna</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <main class="container flex flex-center flex-column" style="gap: 1.5rem">
        <?php echo Card($cardArray); ?>

        <?php if (!empty($cars)) : ?>
            <?php foreach ($cars as $car) : ?>
                <?php
                $image = '<img src="public/uploads/' . $car->getCarInfo()->getDirectoryUrl() . '/' . $car->getCarInfo()->getAvatarUrl() . '">';
                $cardContent2 = $image;
                $cardArray2 = [
                    'content' => $cardContent2,
                    'car' => $car,
                    'car-name' => $car->getCarInfo()->getName(),
                    'car-localization' => $car->getCityName(),
                ];
                ?>

                <?php echo CarCard($cardArray2); ?>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Brak dostępnych samochodów.</p>
        <?php endif; ?>

    </main>
</body>


</html>
