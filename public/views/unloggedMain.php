<?php

require_once "public/views/components/button.php";

$loginButtonArray = [
    'type' => 'submit',
    'value' => 'zaloguj'
];

$registerButtonArray = [
    'type' => 'submit',
    'value' => 'zarejestruj'
];

?>

<html lang="en">

<head> 
    <?php include("public/views/components/headImports.php"); ?>
    <title>Login or register</title>
</head>

<body>
<?php include("public/views/components/navbar.php"); ?>
<main class="info-container container flex flex-center">
    <div class="photo-container">
    <img class="photo drop-shadow" src="public/img/photos/funny-old-family-driving.jpg">
    </div>
    <div class='info-and-buttons flex flex-center flex-column'>
        <h2 class="info-text"> Znajdź swój wymarzony samochód i umów się na jazdę próbną </h2>
        <a href="login"> <?php echo Button($loginButtonArray); ?></a>
        <a href="register"> <?php echo Button($registerButtonArray); ?></a>
    </div>
</main>
</body>

</html>