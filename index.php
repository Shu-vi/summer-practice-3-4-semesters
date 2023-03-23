<?php
include('components/header.php');
include('components/pagination.php');
include('components/dropdown.php');
include('components/book_as_card.php');
include('components/checkbox.php');
include('utils.php');
include('database/database.php');
session_start();
$_SESSION['BOOKS_ON_ONE_PAGE'] = 4;
if (!isset($_SESSION['index_current_page'])) {
    $_SESSION['index_current_page'] = 1;
} elseif (isset($_GET["page"])) {
    $_SESSION['index_current_page'] = $_GET["page"];
}
set_page("index");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Главная страница</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<?php
echo generate_header();
?>

<!--CONTENT START-->
<div class="container-fluid" style="margin-top: 15vh">
    <div class="row">
        <!--FILTERS START-->
        <div class="col-md-3">
            <h3>Фильтры</h3>
            <form action="" method="GET">
                <div class="form-group">
                    <label for="author_name">Имя автора</label>
                    <input type="text" class="form-control" id="author_name" name="author_name"
                           placeholder="Введите имя автора">
                </div>
                <div class="form-group">
                    <label for="author_surname">Фамилия автора</label>
                    <input type="text" class="form-control" id="author_surname" name="author_surname"
                           placeholder="Введите фамилию автора">
                </div>
                <div class="form-group">
                    <label for="title">Поиск по названию</label>
                    <input type="text" class="form-control" id="title" name="title"
                           placeholder="Введите название книги">
                </div>
                <div class="form-group">
                    <label for="genre">Поиск по жанру</label>
                    <input type="text" class="form-control" id="genre" name="genre" placeholder="Введите жанр">
                </div>
                <button type="submit" class="btn btn-primary">Применить фильтры</button>
            </form>
        </div>
        <!--FILTERS FINISH-->

        <!--BOOKS START-->
        <div class="col-md-9">
            Примененные фильтры: <?php
            $filters = '';
            if (isset($_GET["genre"])) {
                if (!empty($_GET["genre"])) {
                    $filters .= $_GET["genre"] . ' ';
                }
            }
            if (isset($_GET["author_name"])) {
                if (!empty($_GET["author_name"])) {
                    $filters .= $_GET["author_name"] . ' ';
                }
            }
            if (isset($_GET["author_surname"])) {
                if (!empty($_GET["author_surname"])) {
                    $filters .= $_GET["author_surname"] . ' ';
                }
            }
            if (isset($_GET["title"])) {
                if (!empty($_GET["title"])) {
                    $filters .= $_GET["title"] . ' ';
                }
            }
            echo $filters;
            ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                $books = [];
                $genre = '';
                $author_name = '';
                $author_surname = '';
                $title = '';
                if (!empty($_GET["genre"])) {
                    $genre = $_GET["genre"];
                    $_SESSION['index_current_page'] = 1;
                }

                if (!empty($_GET["author_name"])) {
                    $author_name = $_GET["author_name"];
                    $_SESSION['index_current_page'] = 1;
                }

                if (!empty($_GET["author_surname"])) {
                    $author_surname = $_GET["author_surname"];
                    $_SESSION['index_current_page'] = 1;
                }

                if (!empty($_GET["title"])) {
                    $title = $_GET["title"];
                    $_SESSION['index_current_page'] = 1;
                }
                try {
                    $books = get_books_by_filters($author_name, $author_surname, $title, $genre);
                    $_SESSION['index_total_books'] = count($books);
                    $books = array_slice($books, ($_SESSION['index_current_page'] - 1) * $_SESSION['BOOKS_ON_ONE_PAGE'], $_SESSION['BOOKS_ON_ONE_PAGE']);
                    $num = count($books);
                    $res = '';
                    if (!empty($books)) {
                        foreach ($books as $book) {
                            // Получаем авторов книги по ее id
                            $authors = get_authors_by_book_id($book['id']);

                            // Формируем строку со списком авторов
                            $authors_res = 'Авторы: ';
                            foreach ($authors as $author) {
                                $authors_res .= $author['name'] . ' ' . $author['surname'] . ', ';
                            }
                            // Удаляем последнюю запятую и пробел из строки со списком авторов
                            $authors_res = rtrim($authors_res, ', ');

                            $genres = get_genres_by_book_id($book['id']);
                            $genres_res = 'Жанры: ';
                            foreach ($genres as $i){
                                $genres_res .= $i['title'].', ';
                            }
                            $genres_res = rtrim($genres_res, ', ');
                            $res .= generate_book($book, $authors_res, $genres_res);
                        }
                    }
                    if (!empty($res)) {
                        echo $res;
                    } else {
                        echo "<div>Ничего не найдено!</div>";
                    }
                } catch (Exception $e){
                    echo "<div>Непредвиденная ошибка!</div>";
                }
                ?>
            </div>
            <?php
            echo generate_pagination($_SESSION['index_total_books'], $_SESSION['index_current_page'], $_SESSION['BOOKS_ON_ONE_PAGE']);
            ?>
        </div>
    </div>
    <!--CONTENT FINISH-->
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>