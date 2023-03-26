<?php
function generate_header()
{
    $index = "";
    $auth = "";
    $registr = "";
    $my_books = "";
    $favourites = "";
    $predict = "";
    $admin = '';
    if (isset($_SESSION["index"])) {
        $index = "active";
    } elseif (isset($_SESSION["auth"])) {
        $auth = "active";
    } elseif (isset($_SESSION["registr"])) {
        $registr = "active";
    } elseif (isset($_SESSION["my_books"])) {
        $my_books = "active";
    } elseif (isset($_SESSION["favourites"])) {
        $favourites = "active";
    } elseif (isset($_SESSION["predict"])) {
        $predict = "active";
    } elseif (isset($_SESSION["admin"])){
        $admin = 'active';
    }
    if (isset($_SESSION['user'])) {
        $id = $_SESSION['user']['id'];
    }
    //для админа
    if (isset($_SESSION["user"]) && $_SESSION['user']['role'] == 'ADMIN'){
        $username = $_SESSION["user"]["name"];

        return "
            <nav class=\"navbar navbar-dark bg-dark fixed-top\">
        <div class=\"container-fluid\">
            <a class=\"navbar-brand\" style=\"text-transform: uppercase\" href=\"/library/index.php\">Библиотека</a>
            <div class=\"d-flex align-items-center\">
                <div class=\"text-white\" style='margin-right: 10px;'>id: $id</div>
                <div class=\"text-white\" style='margin-right: 10px;'>$username</div>
                <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"offcanvas\" data-bs-target=\"#offcanvasDarkNavbar\" aria-controls=\"offcanvasDarkNavbar\">
                    <span class=\"navbar-toggler-icon\"></span>
                </button>
            </div>
            <div class=\"bg-dark offcanvas offcanvas-end text-bg-dark\" tabindex=\"-1\" id=\"offcanvasDarkNavbar\" aria-labelledby=\"offcanvasDarkNavbarLabel\">
                <div class=\"offcanvas-header\">
                    <h5 class=\"offcanvas-title text-white\" id=\"offcanvasDarkNavbarLabel\">$username</h5>
                    <button type=\"button\" class=\"btn-close btn-close-white\" data-bs-dismiss=\"offcanvas\" aria-label=\"Close\"></button>
                </div>
                
                <div class=\"offcanvas-body\">
                    <ul class=\"navbar-nav justify-content-end flex-grow-1 pe-3\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link $index\" aria-current=\"page\" href=\"/library/index.php\">Главная</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link $predict\" href=\"/library/predict.php\">Подборка книг</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link $favourites\" href=\"/library/favourites.php\">Избранное</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link $my_books\" href=\"/library/my_books.php\">Читаю сейчас</a>
                        </li
                        <li class=\"nav-item\">
                            <a class=\"nav-link $admin\" href=\"/library/admin/give_book.php\">Админка</a>
                        </li
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"/library/handlers/exit_handler.php\">Выйти</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
        ";
    }
    //для обычного пользователя
    if (isset($_SESSION["user"])){
        $username = $_SESSION["user"]["name"];
        return "
            <nav class=\"navbar navbar-dark bg-dark fixed-top\">
        <div class=\"container-fluid\">
            <a class=\"navbar-brand\" style=\"text-transform: uppercase\" href=\"/library/index.php\">Библиотека</a>
            <div class=\"d-flex align-items-center\">
                <div class=\"text-white\" style='margin-right: 10px;'>id: $id</div>
                <div class=\"text-white\" style='margin-right: 10px;'>$username</div>
                <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"offcanvas\" data-bs-target=\"#offcanvasDarkNavbar\" aria-controls=\"offcanvasDarkNavbar\">
                    <span class=\"navbar-toggler-icon\"></span>
                </button>
            </div>
            <div class=\"bg-dark offcanvas offcanvas-end text-bg-dark\" tabindex=\"-1\" id=\"offcanvasDarkNavbar\" aria-labelledby=\"offcanvasDarkNavbarLabel\">
                <div class=\"offcanvas-header\">
                    <h5 class=\"offcanvas-title text-white\" id=\"offcanvasDarkNavbarLabel\">$username</h5>
                    <button type=\"button\" class=\"btn-close btn-close-white\" data-bs-dismiss=\"offcanvas\" aria-label=\"Close\"></button>
                </div>
                
                <div class=\"offcanvas-body\">
                    <ul class=\"navbar-nav justify-content-end flex-grow-1 pe-3\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link $index\" aria-current=\"page\" href=\"/library/index.php\">Главная</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link $predict\" href=\"/library/predict.php\">Подборка книг</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link $favourites\" href=\"/library/favourites.php\">Избранное</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link $my_books\" href=\"/library/my_books.php\">Читаю сейчас</a>
                        </li
                        <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"/library/handlers/exit_handler.php\">Выйти</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
        ";
    }
    //для неавтриз
    return "
    <nav class=\"navbar navbar-dark bg-dark fixed-top\">
        <div class=\"container-fluid\">
            <a class=\"navbar-brand\" style=\"text-transform: uppercase\" href=\"/library/index.php\">Библиотека</a>
            <div class=\"d-flex align-items-center\">
                <div class=\"text-white\"></div>
                <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"offcanvas\" data-bs-target=\"#offcanvasDarkNavbar\" aria-controls=\"offcanvasDarkNavbar\">
                    <span class=\"navbar-toggler-icon\"></span>
                </button>
            </div>
            <div class=\"bg-dark offcanvas offcanvas-end text-bg-dark\" tabindex=\"-1\" id=\"offcanvasDarkNavbar\" aria-labelledby=\"offcanvasDarkNavbarLabel\">
                <div class=\"offcanvas-header\">
                    <h5 class=\"offcanvas-title text-white\" id=\"offcanvasDarkNavbarLabel\"></h5>
                    <button type=\"button\" class=\"btn-close btn-close-white\" data-bs-dismiss=\"offcanvas\" aria-label=\"Close\"></button>
                </div>
                <div class=\"offcanvas-body\">
                    <ul class=\"navbar-nav justify-content-end flex-grow-1 pe-3\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link $index\" aria-current=\"page\" href=\"/library/index.php\">Главная</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link $auth\" href=\"/library/auth.php\">Войти</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link $registr\" href=\"/library/registr.php\">Зарегистрироваться</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    ";
}

?>