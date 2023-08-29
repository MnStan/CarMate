<?php

require_once "public/views/components/input.php";
require_once "public/views/components/form.php";
require_once "public/views/components/card.php";
require_once "public/views/components/button.php";

$SessionController = new SessionController();
if ($SessionController::isLogged()) {
    $SessionController->redirectToHome();
}

$Repository = new Repository;
$cities = $Repository->getAllCities();

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
        <?php
        // echo Card($cardArray); 
        ?>
        <?php
        // echo Button($buttonArray); 
        ?>
        <form style="background-color:#999" class="login-form" action="checkRegister" method="POST">
            <div class="login-error-message">
                <?php echo $messages['error']; ?>
            </div>
            <input class="input input-text-primary" type="text" name="email" placeholder="Podaj email" value="<?php if (isset($messages['email']))
                echo $messages['email']; ?>" required>
            <input class="input input-text-primary" type="password" name="password" placeholder="Podaj hasło" required>
            <input class="input input-text-primary" type="password" name="password2" placeholder="Powtórz hasło"
                required>
            <input class="input input-text-primary" type="text" name="name" placeholder="Imię" value="<?php if (isset($messages['name']))
                echo $messages['name']; ?>" required>
            <input class="input input-text-primary" type="text" name="surname" placeholder="Nazwisko" value="<?php if (isset($messages['surname']))
                echo $messages['surname']; ?>" required>
            <input class="input input-text-primary" type="text" name="phone" placeholder="Numer telefonu (np. +48 ...)"
                value="<?php if (isset($messages['phone']))
                    echo $messages['phone']; ?>" required>
            <select name="city" required>
                <?php
                foreach ($cities as $city) {
                    echo '<option value="' . $city[0] . '">' . $city[1] . '</option>';
                }
                ?>
            </select>
            <input class="input input-text-primary" type="text" name="address" placeholder="Adres zamieszkania" value="<?php if (isset($messages['address']))
                echo $messages['address']; ?>" required>
            <button class='button button-primary drop-shadow-animate' type='submit'>Zarejestruj</button>
            <br>
            <div style="font-size: 1.1rem; color: white;">Masz juz konto?</div>
            <a class="button button-primary" href="login">Zaloguj</a>
        </form>
    </main>
</body>

</html>