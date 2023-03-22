<?php
include('components/header.php');
include('components/go_to_back.php');
include('utils.php');
include('database/database.php');
session_start();
set_page("auth");
if (isset($_SESSION['auth_incorrect_data'])){
    unset($_SESSION['auth_incorrect_data']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Авторизация</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<?php
if (isset($_SESSION["user"])) {
    echo generate_go_to_home();
    exit();
}
?>
<?php
echo generate_header();
?>
<!--Блок регистрации старт-->
<div class="card bg-dark text-white pt-5 pb-5 min-vh-100" style="padding: 0 200px 0 200px;">
    <div class="card-body mt-5">
        <h5 class="card-title">Вход</h5>
        <form method="post" action="">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="auth_email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" name="auth_password">
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Войти</button>
                <div>Нет аккаунта? <a href="./registr.php">Зарегистрируйтесь!</a></div>
                <?php
                if (isset($_POST["auth_email"]) && isset($_POST["auth_password"])) {
                    if (!empty($_POST['auth_email']) && !empty($_POST["auth_password"])) {
                        $user = get_user_by_login($_POST["auth_email"]);
                        if (!empty($user)) {
                            if ($_POST["auth_password"] == $user["password"]) {
                                $_SESSION["user"] = $user;
                                header('Location: ' . '/library/index.php');
                            } else {
                                $_SESSION['auth_incorrect_data'] = true;
                            }
                        } else {
                            $_SESSION['auth_incorrect_data'] = true;
                        }
                    } else {
                        $_SESSION['auth_incorrect_data'] = true;
                    }
                }
                ?>
            </div>
            <div class="text-white">
                <?php
                if (isset($_SESSION['auth_incorrect_data'])) {
                    echo "Неправильный логин или пароль";
                }
                ?>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>