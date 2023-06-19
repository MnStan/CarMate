<?php

require_once "public/views/components/input.php";
require_once "public/views/components/form.php";
require_once "public/views/components/card.php";
require_once "public/views/components/carCard.php";
require_once "public/views/components/button.php";

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

$cardContent = Form($formContent);

$cardArray = [
    'title' => 'Znajdź samochód dla siebie',
    'content' => $cardContent
];

$image = '<img src="public/img/photos/toyota.jpg">';

$cardContent2 = $image;

$cardArray2 = [
    'content' => $cardContent2,
    'car-name' => 'Toyota Chaser JZX100',
    'car-price' => 'od 1000zł'
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
        <?php echo CarCard($cardArray2); ?>
        <?php echo CarCard($cardArray2); ?>
        <?php echo CarCard($cardArray2); ?>
        <?php echo CarCard($cardArray2); ?>
        <?php echo CarCard($cardArray2); ?>
        <?php echo CarCard($cardArray2); ?>
    </main>
</body>

</html>