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

$formContent = [
    'action' => '',
    'method' => 'POST',
    'content' => $addCarAndPreview
];

?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <script src="public/js/preview-interactions.js" defer></script>    
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
                <div class="info-info flex flex-row">
                    <?php echo RentInfo('Toyota', 'Testowanie tooltip'); ?>
                    <?php echo RentInfo('Chaser'); ?>
                    <?php echo RentInfo('JZX100'); ?>
                    <?php echo RentInfo('3litry'); ?>
                    <?php echo RentInfo('400km'); ?>
                    <?php echo RentInfo('56893km'); ?>
                    <?php echo RentInfo('Toyota', 'Testowanie tooltip'); ?>
                    <?php echo RentInfo('Chaser'); ?>
                    <?php echo RentInfo('JZX100'); ?>
                    <?php echo RentInfo('3litry'); ?>
                    <?php echo RentInfo('400km'); ?>
                    <?php echo RentInfo('56893km'); ?>
                </div>

                <h3>
                    Warunki
                </h3>
                <div class="info-info flex flex-row">
                    <?php echo RentInfo('100 km'); ?>
                    <?php echo RentInfo('tylko z właścicielem'); ?>
                    <?php echo RentInfo('2 godziny'); ?>
                </div>
            </div>
        </div>
        <?php echo Button($buttonArrayCarInfo); ?>
    </main>
</body>

</html>