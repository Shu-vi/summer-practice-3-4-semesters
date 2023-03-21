<?php
include('components/header.php');
include('utils.php');
session_start();
set_page("profile");
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Мой профиль</title>
</head>
<body>
<?php
if (!isset($_SESSION["user"])){
    echo get_need_auth_block();
    exit();
}
?>
<?php
echo generate_header();
?>
<div class="card bg-dark text-white pt-5 pb-5 min-vh-100" style="padding: 0 200px 0 200px;">
    <div class="card-body mt-5">
        <h5 class="card-title">Личные данные</h5>
        <form>
            <div class="mb-3 opacity-50">
                <label for="name" class="form-label">Имя</label>
                <input readonly type="text" class="form-control" id="name">
            </div>
            <div class="mb-3 opacity-50">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" readonly id="email">
            </div>
            <div class="mb-3 opacity-50">
                <label for="password" class="form-label">Пароль</label>
                <input readonly type="password" class="form-control" id="password">
            </div>
            <div class="mb-3 d-none">
                <label for="confirm-password" class="form-label">Для подтверждения введите старый пароль</label>
                <input type="password" class="form-control" id="confirm-password">
            </div>
            <button type="submit" class="btn btn-primary">Редактировать</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
