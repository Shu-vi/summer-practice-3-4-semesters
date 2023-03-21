<?php
include('components/header.php');
include('components/go_to_back.php');
include('utils.php');
include('database/database.php');
session_start();
set_page("registr");
if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    add_user($_POST["name"], $_POST["email"], $_POST["password"]);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<?php
if (isset($_SESSION["user"])){
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
        <h5 class="card-title">Регистрация</h5>
        <form method="post" action="registr.php">
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                <div>Уже есть аккаунт? <a href="./auth.php">Войдите!</a></div>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>