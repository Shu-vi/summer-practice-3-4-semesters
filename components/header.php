<?php
function generate_header()
{
    $index = "";
    $auth = "";
    $registr = "";
    $my_books = "";
    $favourites = "";
    $profile = "";
    $predict = "";
    $username = "";
    if (isset($_SESSION["index"])) {
        $index = "active";
    } elseif (isset($_SESSION["auth"])) {
        $auth = "active";
    } elseif (isset($_SESSION["registr"])){
        $registr = "active";
    } elseif (isset($_SESSION["my_books"])){
        $my_books = "active";
    } elseif (isset($_SESSION["favourites"])){
        $favourites = "active";
    } elseif (isset($_SESSION["profile"])){
        $profile = "active";
    } elseif (isset($_SESSION["predict"])){
        $predict = "active";
    }

    return "
    <nav class=\"navbar navbar-dark bg-dark fixed-top\">
        <div class=\"container-fluid\">
            <a class=\"navbar-brand\" style=\"text-transform: uppercase\" href=\"./index.php\">Библиотека</a>
            <div class=\"d-flex align-items-center\">
                <div class=\"text-white\">username</div>
                <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"offcanvas\" data-bs-target=\"#offcanvasDarkNavbar\" aria-controls=\"offcanvasDarkNavbar\">
                    <span class=\"navbar-toggler-icon\"></span>
                </button>
            </div>
            <div class=\"bg-dark offcanvas offcanvas-end text-bg-dark\" tabindex=\"-1\" id=\"offcanvasDarkNavbar\" aria-labelledby=\"offcanvasDarkNavbarLabel\">
                <div class=\"offcanvas-header\">
                    <h5 class=\"offcanvas-title text-white\" id=\"offcanvasDarkNavbarLabel\">Username</h5>
                    <button type=\"button\" class=\"btn-close btn-close-white\" data-bs-dismiss=\"offcanvas\" aria-label=\"Close\"></button>
                </div>
                <div class=\"offcanvas-body\">
                    <ul class=\"navbar-nav justify-content-end flex-grow-1 pe-3\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link $index\" aria-current=\"page\" href=\"./index.php\">Главная</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link $predict\" href=\"./predict.php\">Подборка книг</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link $favourites\" href=\"#\">Избранное</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link $my_books\" href=\"./my_books.php\">Читаю сейчас</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link $profile\" href=\"#\">Профиль</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"#\">Выйти</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    ";
}

?>