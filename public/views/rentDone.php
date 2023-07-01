<?php

require_once "public/views/components/card.php";
require_once "public/views/components/button.php";
require_once "public/views/components/buttonRedirect.php";

$buttonRedirect = [
    'link' => 'main',
    'value' => 'Strona głowna',
];

$cardArray = [
    'title' => 'Dziękujemy za skorzystanie z naszej strony<br><br>
    
    Informacja została przekazana do właściciela',
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
        <?php echo ButtonRedirect($buttonRedirect) ?>
    </main>
</body>

</html>