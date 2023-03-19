<?php
include('components/header.php');
include('utils.php');
session_start();
setPage("registr");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <?php
    echo generate_header();
    ?>

    <!--Блок регистрации старт-->
    <div class="card bg-dark text-white pt-5 pb-5 min-vh-100" style="padding: 0 200px 0 200px;">
        <div class="card-body mt-5">
            <h5 class="card-title">Регистрация</h5>
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Имя</label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label">Фамилия</label>
                    <input type="text" class="form-control" id="surname">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Номер телефона</label>
                    <input type="text" class="form-control" id="phone">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Домашний адрес</label>
                    <input type="text" class="form-control" id="address">
                </div>
                <ul class="list-group">
                    <li class="list-group-item bg-dark text-white border-dark">
                        <input class="form-check-input me-1" type="radio" name="gender" value="" id="male" checked>
                        <label class="form-check-label" for="male">Мужчина</label>
                    </li>
                    <li class="list-group-item bg-dark text-white border-dark">
                        <input class="form-check-input me-1" type="radio" name="gender" value="" id="female">
                        <label class="form-check-label" for="female">Женщина</label>
                    </li>
                </ul>
                <div class="mb-3">
                    <label for="username" class="form-label">Имя пользователя</label>
                    <input type="text" class="form-control" id="username">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="password">
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Подтверждение пароля</label>
                    <input type="password" class="form-control" id="confirm-password">
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                    <div>Уже есть аккаунт? <a href="./auth.php">Войдите!</a></div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>