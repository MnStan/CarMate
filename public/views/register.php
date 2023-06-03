<?php

require_once "public/views/components/input.php";
require_once "public/views/components/form.php";
require_once "public/views/components/card.php";
require_once "public/views/components/button.php";

$inputNicknamee = [
    'type' => 'name',
    'name' => 'nickname',
    'placeholder' => 'nazwa użytkownika',
    'value' => $messages['nickname'],
    'image' => 'public/img/input/user-regular.svg',
];

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
    'content' => Input($inputNicknamee) . Input($inputEmail) . Input($inputPassword)
];

$cardContent = Form($formContent);

$cardArray = [
    'title' => 'Rejestracja',
    'content' => $cardContent
];

$buttonArray = [
    'type' => 'submit',
    'value' => 'zarejestruj'
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