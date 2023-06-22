<?php

require_once "public/views/components/rentInfoBean.php";
require_once "public/views/components/card.php";
require_once "public/views/components/button.php";
require_once "public/views/components/form.php";
require_once "public/views/components/input.php";

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
    <input type="file" name="car" accept=".jpg, .jpeg" id="car-input">
    <img id="car-preview" class="car-preview" src="#" alt="Podgląd" style="display: none";>
';

$plusButtonArray = [
    'value' => '+',
    'id' => 'add-car-info'
];

$secondPlusButtonArray = [
    'value' => '+',
    'id' => 'add-rent-info'
];

$formContent = [
    'action' => '',
    'method' => 'POST',
    'content' => $addCarAndPreview
];

$carRentInfoElements = [
    RentInfo('Marka', 'true'),
    RentInfo('Model', 'true'),
    RentInfo('Pojemność silnika', 'true'),
    RentInfo('moc', 'true'),
    RentInfo('przebieg', 'true')
];

$RentInfoElements = [
    RentInfo('Maksymalny przebieg', 'true'),
    RentInfo('Z właścicielem?', 'true'),
    RentInfo('Maksymalny czas', 'true'),
];

?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <script src="public/js/preview-interactions.js" defer></script>
    <script src="public/js/addRentInfo.js" defer></script>
    <title>Informacje</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <main class="container flex flex-center flex-column" style="gap: 1.5rem">
        <div class="car-photo-container">
            <?php echo Form($formContent); ?>
        </div>
        <div class="rent-info container flex flex-center flex-column">
            <div class="rent-info-container">
                <h3>
                    Właściciel
                </h3>
                <div class="info-info flex flex-row">
                    <?php echo RentInfo('Maksymilian Stan') ?>
                    <?php echo RentInfo('Kraków'); ?>
                </div>

                <h3>
                    Informacje o samochodzie
                </h3>
                <div class="info-info flex flex-row" id="car-info-container">
                    <?php foreach ($carRentInfoElements as $element) {
                        echo $element;
                    } 
                    ?>
                </div>

                <div class="center-button">
                    <?php echo Button($plusButtonArray); ?>
                </div>

                <h3>
                    Warunki
                </h3>
                <div class="info-info flex flex-row" id="rent-info-container">
                <?php foreach ($RentInfoElements as $element) {
                        echo $element;
                    } ?>
                </div>

                <div class="center-button">
                    <?php echo Button($secondPlusButtonArray); ?>
                </div>

            </div>
        </div>
        <?php echo Button($buttonArrayCarInfo); ?>
    </main>
</body>

</html>
