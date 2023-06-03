<?php

require_once "public/views/components/input.php";
require_once "public/views/components/form.php";
require_once "public/views/components/card.php";
require_once "public/views/components/button.php";

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

$formContent = [
    'action' => 'checkLogin',
    'method' => 'POST',
    'content' => Input($inputEmail) . Input($inputPassword)
];

$cardContent = Form($formContent) . '<a class="text-center" href="register">Nie nasz jeszcze konta?</a>';

$cardArray = [
    'title' => 'Logowanie',
    'content' => $cardContent
];

$buttonArray = [
    'type' => 'submit',
    'value' => 'zaloguj'
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
    <?php echo Card($cardArray); ?>
    <?php echo Button($buttonArray); ?>
</main>
</body>

</html>