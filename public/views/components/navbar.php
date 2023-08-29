<?php

$SessionController = new SessionController();

?>

<header class="header" id="header">
    <div class="drop-shadow">
        <nav class="nav container">
            <div class="navbar-brand">
                <a href="main">
                    <img class="navbar-brand-logo" src="public/img/logo/CarMateLogo.svg" alt="Logo CarMate">
                </a>
            </div>
            <div class="navbar-list-d-none-sx">
                <?php
                if ($SessionController::isLogged()) {
                    echo '<a href="logout">Wyloguj</a>';
                } else {
                    echo '<a href="login">Zaloguj</a>';
                    echo '<a href="register">Zarejestruj</a>';
                }
                ?>
            </div>
        </nav>
    </div>
</header>
