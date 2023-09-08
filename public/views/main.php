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
$userInfo = $SessionController->unserializeUser();
$userCity = $userInfo->getUserInfo()->getCityName();

$searchInput = [
    'type' => 'text',
    'name' => 'search',
    'placeholder' => 'Marka, Model',
    'image' => 'public/img/input/lock-solid.svg',
];

$formContent = [
    'action' => 'searchCars',
    'method' => 'POST',
    'content' => Input($searchInput)
];

$cardContent = Form($formContent, null);

$cardArray = [
    'title' => 'Znajdź samochód dla siebie',
    'content' => $cardContent
];

$searchResults = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchTerm = $_POST['search'];
    $carRepository = new CarRepository();
    $searchResults = $carRepository->searchCarsByModelOrCity($searchTerm);
}

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

        <?php

if (!empty($searchResults)) {
    foreach ($searchResults as $car) {
        $image = '<img src="public/uploads/' . $car->getCarInfo()->getDirectoryUrl() . '/' . $car->getCarInfo()->getAvatarUrl() . '">';
        $cardContent2 = $image;
        $cardArray2 = [
            'content' => $cardContent2,
            'car' => $car,
            'car-name' => $car->getCarInfo()->getName(),
            'car-localization' => $car->getCityName(),
        ];
        echo CarCard($cardArray2);
    }
} else {
    $carsFromUserCity = $carController->getAllCars();

    if (!empty($carsFromUserCity)) {
        foreach ($carsFromUserCity as $car) {
            $image = '<img src="public/uploads/' . $car->getCarInfo()->getDirectoryUrl() . '/' . $car->getCarInfo()->getAvatarUrl() . '">';
            $cardContent2 = $image;
            $cardArray2 = [
                'content' => $cardContent2,
                'car' => $car,
                'car-name' => $car->getCarInfo()->getName(),
                'car-localization' => $car->getCityName(),
            ];
            echo CarCard($cardArray2);
        }
    } else {
        echo "<p>Brak dostępnych samochodów.</p>";
    }
}

?>


    </main>
    <?php include('public/views/components/footer.php'); ?>
</body>

</html>
