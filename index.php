<?php
include('components/header.php');
include('components/pagination.php');
include('components/dropdown.php');
include('components/book_as_card.php');
include('components/checkbox.php');
include('utils.php');
include('database/database.php');
session_start();
if (!isset($_SESSION['index_current_page'])){
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
                    <input type="text" class="form-control" id="author_name" name="author_name" placeholder="Введите имя автора">
                </div>
                <div class="form-group">
                    <label for="author_surname">Фамилия автора</label>
                    <input type="text" class="form-control" id="author_surname" name="author_surname" placeholder="Введите фамилию автора">
                </div>
                <div class="form-group">
                    <label for="title">Поиск по названию</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Введите название книги">
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
                if (isset($_GET["genres"])){
                    $num = count($_GET["genres"]);
                    for ($i = 0; $i < $num; $i++){
                        $filters .= ' '.$_GET["genres"][$i];
                    }
                }
                if (isset($_GET["authors"]) && $_GET["authors"][0] != 'Выберите значение'){
                    $filters .= ' '.$_GET["authors"][0];
                }
                echo $filters;
            ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                $books = null;
                if (isset($_GET["authors"]) && isset($_GET["genres"])){
                    $books = get_books_by_genres_and_author($_GET["genres"], $_GET["authors"]);
                } elseif (isset($_GET["authors"])){
                    $books = get_books_by_genres_and_author(null, $_GET["authors"]);
                } elseif (isset($_GET["genres"])){
                    $books = get_books_by_genres_and_author($_GET["genres"], null);
                } else{
                    $books = get_books();
                }
                $_SESSION['index_total_books'] = count($books);
                $books = array_slice($books, ($_SESSION['index_current_page']-1) * 9, 9);
                $num = count($books);
                $res = '';
                if (isset($books)){
                    for ($i = 0; $i < $num; $i++) {
                        $authors = get_authors_by_book_id($books[$i]['id']);
                        $num2 = count($authors);
                        $authors_res = 'Авторы: ';
                        for ($j = 0; $j < $num2; $j++) {
                            if ($j == $num2 -1){
                                $authors_res .= $authors[$j]["name"]." ".$authors[$j]["surname"];
                            } else{
                                $authors_res .= $authors[$j]["name"]." ".$authors[$j]["surname"].', ';
                            }
                        }
                        $res .= generate_book($books[$i]['title'], $authors_res, $books[$i]['id']);
                    }
                }
                echo $res;
                ?>
            </div>
            <?php
            echo generate_pagination($_SESSION['index_total_books'], $_SESSION['index_current_page'], 9);
            ?>
        </div>
    </div>
    <!--CONTENT FINISH-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</body>
</html>