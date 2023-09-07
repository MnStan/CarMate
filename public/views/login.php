<?php

require_once "public/views/components/input.php";
require_once "public/views/components/form.php";
require_once "public/views/components/card.php";
require_once "public/views/components/button.php";

$SessionController = new SessionController();
if ($SessionController::isLogged()) {
    $SessionController->redirectToHome();
}

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

$buttonArray = [
    'type' => 'submit',
    'value' => 'zaloguj'
];

$formContent = [
    'action' => 'checkLogin',
    'method' => 'POST',
    'content' => Input($inputEmail) . Input($inputPassword) . Button($buttonArray)
];

$onSubmitLoginFunction = 'validateAddCarForm';

$cardContent = Form($formContent, $onSubmitLoginFunction) . '<a class="text-center" href="register">Nie nasz jeszcze konta?</a>';

$cardArray = [
    'title' => 'Logowanie',
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
        <div class="login-error-message">
        <?php echo $messages['error']; ?>
        </div>
        <?php echo Card($cardArray); ?>
    </main>
</body>

</html>