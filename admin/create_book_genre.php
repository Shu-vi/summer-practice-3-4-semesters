<?php
include('../components/header.php');
include('../components/need_auth.php');
include('../utils.php');
include('../components/admin_bar.php');
include('../database/database.php');
session_start();
set_page("admin");

if (isset($_SESSION['create_book_err'])) {
    $_SESSION['create_book_temp'] = true;
    unset($_SESSION['create_book_err']);
}
if (isset($_SESSION['create_book_suc'])) {
    unset($_SESSION['create_book_suc']);
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
    $book_id = 0;
    $book_genre = '';

    if (!empty($_POST['book_id'])) {
        $book_id = $_POST['book_id'];
    }
    if (!empty($_POST['book_genre'])) {
        $book_genre = $_POST['book_genre'];
    }

    //создать книгу
    if (!empty($book_id) && !empty($book_genre)) {
        try {
            $res = add_genre_to_book($book_id, $book_genre);
            if ($res){
                $_SESSION['create_book_suc'] = true;
            } else{
                $_SESSION['create_book_err'] = true;
            }
        } catch (Exception $e) {
            $_SESSION['create_book_err'] = true;
        }
    } else {
        $_SESSION['create_book_err'] = true;
    }


    ?>
    <form method="post" action="">
        <h1>Добавить жанр книге</h1>
        <?php
        if (isset($_SESSION['create_book_err'])) {
            echo "<h5 style='color: hotpink'>Неудача</h5>";
        }
        if (isset($_SESSION['create_book_suc'])) {
            echo "<h5 style='color: darkgreen'>Успех</h5>";
        }
        ?>
        <div class="mb-3">
            <label for="book_id" class="form-label">Id книги</label>
            <input type="text" class="form-control" id="book_id" name="book_id">
        </div>
        <div class="mb-3">
            <label for="book_genre" class="form-label">Название жанра(например: "Фантастика")</label>
            <input type="text" class="form-control" id="book_genre" name="book_genre">
        </div>
        <button type="submit" class="btn btn-secondary">Принять</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
