<?php
include('../components/header.php');
include('../components/need_auth.php');
include('../utils.php');
include('../components/admin_bar.php');
include('../database/database.php');
session_start();
set_page("admin");

if (isset($_SESSION['get_book_err'])) {
    unset($_SESSION['get_book_err']);
}
if (isset($_SESSION['get_book_suc'])) {
    unset($_SESSION['get_book_suc']);
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Админка</title>
</head>
<body>
<?php
if (!isset($_SESSION["user"]) || $_SESSION['user']['role'] != 'ADMIN') {
    echo get_need_auth_block();
    exit();
}
?>
<?php
echo generate_header();
?>
<div class="container mt-5">
    <?php
    echo get_admin_links();
    ?>
    <?php
    //получить данные из формы
    $user_id = 0;
    $book_id = 0;
    if (!empty($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
    }
    if (!empty($_POST['book_id'])) {
        $book_id = $_POST['book_id'];
    }

    //Если данные введены
    if (!empty($user_id) && !empty($book_id)) {
        //Если запись с такими юзер айди и бук айди существует
        try {
            $book = get_readble_by_user_id_and_book_id($user_id, $book_id);
            if (empty($book)) {
                $_SESSION['get_book_err'] = true;
            } else {//Иначе добавить в БД
                //Удалить из бд у юзера книгу
                $res = delete_book_from_readble_by_book_id_and_user_id($book_id, $user_id);
                if (!empty($res)) {
                    $_SESSION['get_book_suc'] = true;
                }
            }
        } catch (Exception $e){
            $_SESSION['get_book_err'] = true;
        }

    } else {
        $_SESSION['get_book_err'] = true;
    }


    ?>
    <form method="post" action="">
        <h1>Принять книгу</h1>
        <?php
        if (isset($_SESSION['get_book_err'])) {
            echo "<h5 style='color: hotpink'>Ошибка. Книга не была принята в системе</h5>";
        }
        if (isset($_SESSION['get_book_suc'])) {
            echo "<h5 style='color: darkgreen'>Книга успешно принята в системе</h5>";
        }
        ?>
        <div class="mb-3">
            <label for="user_id" class="form-label">Id пользователя</label>
            <input type="number" class="form-control" id="user_id" name="user_id">
        </div>
        <div class="mb-3">
            <label for="book_id" class="form-label">Id книги</label>
            <input type="number" class="form-control" id="book_id" name="book_id">
        </div>
        <button type="submit" class="btn btn-secondary">Принять</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
