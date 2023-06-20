<?php
require_once "public/views/components/button.php";
require_once "public/views/components/rentInfoBean.php";

$buttonArrayCarInfo = [
    'type' => 'submit',
    'value' => 'zarezerwuj jazdę próbną'
];
?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <title>Rezerwuj</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <main class="container flex flex-center flex-column" style="gap: 1.5rem">
        <form>
            <div>
                <label for="datePickerInput"><h3>Wybierz datę:</h3></label>
                <input type="date" id="datePickerInput" name="datePickerInput">
            </div>
            <?php echo RentInfo('100 zł'); ?>
            <?php echo Button($buttonArrayCarInfo); ?>
        </form>
    </main>
</body>

</html>
