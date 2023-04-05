<?php
include('../components/header.php');
include('../components/need_auth.php');
include('../utils.php');
include('../components/admin_bar.php');
include('../database/database.php');
session_start();
set_page("admin");

if (isset($_SESSION['create_book_err'])) {
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
    $book_title = '';
    $book_date = '';
    $book_page_count = 0;

    if (!empty($_POST['book_title'])) {
        $book_title = $_POST['book_title'];
    }
    if (!empty($_POST['book_date'])) {
        $book_date = $_POST['book_date'];
    }
    if (!empty($_POST['book_page_count'])) {
        $book_page_count = $_POST['book_page_count'];
    }

    //создать книгу
    if (!empty($book_title) && !empty($book_date) && !empty($book_page_count)){
        try {
            $res = create_book_by_title_and_date_and_count($book_title, $book_date, $book_page_count);
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
        <h1>Добавить книгу</h1>
        <h5>Авторов и жанры необходимо добавить к книге отдельно</h5>
        <?php
        if (isset($_SESSION['create_book_err'])) {
            echo "<h5 style='color: hotpink'>Ошибка. Книга не была создана</h5>";
        }
        if (isset($_SESSION['create_book_suc'])) {
            echo "<h5 style='color: darkgreen'>Книга успешно добавлена</h5>";
        }
        ?>
        <div class="mb-3">
            <label for="book_title" class="form-label">Название книги</label>
            <input type="text" class="form-control" id="book_title" name="book_title">
        </div>
        <div class="mb-3">
            <label for="book_date" class="form-label">Дата написания книги в формате гггг-мм-дд</label>
            <input type="text" class="form-control" id="book_date" name="book_date">
        </div>
        <div class="mb-3">
            <label for="book_page_count" class="form-label">Количество страниц</label>
            <input type="text" class="form-control" id="book_page_count" name="book_page_count">
        </div>
        <button type="submit" class="btn btn-secondary">Добавить</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
