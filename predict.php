<?php
include('components/header.php');
include('components/dropdown.php');
include('components/checkbox.php');
include('components/book_as_card.php');
include('utils.php');
include('database/database.php');
include('components/need_auth.php');
session_start();
set_page("predict");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Рекомендации для прочтения</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<?php
if (!isset($_SESSION["user"])) {
    echo get_need_auth_block();
    exit();
}
?>
<?php
echo generate_header();
?>
<div class="card bg-dark text-white pt-5 pb-5 min-vh-100" style="padding: 0 200px 0 200px;">
    <div class="card-body mt-5">
        <h5 class="card-title">Рекомендации</h5>
        <h6>*Здесь вы можете получить подборку из 5 случайных книг, которых нет у вас на руках и в избранном. В целом,
            число книг может быть
            и меньше 5, если нашлось слишком малое количество книг, удовлетворяющих результатам вашего поиска</h6>
        <form class="mb-5" action="" method="GET">
            <?php
            $authors = get_all_authors();
            $genres = get_all_genres();
            $_SESSION["genres"] = $genres;
            echo generate_dropdown("Авторы", $authors, 'authors[]');
            //print_r($_GET['authors']); //здесь хранится айдишник выбранного автора
            echo "<div class='text-white'>Жанры</div>";
            echo generate_checkbox($genres, 'genres[]');
            ?>
            <button type="submit" class="btn btn-primary">Получить рекомендацию</button>
        </form>
        <div class="row row-cols-1 row-cols-md-3 g-4 text-black">
            <?php
            try {
                $books = null;
                if (isset($_GET["genres"])) {
                    $books = get_unique_books($_SESSION['user']['id'], $_GET["authors"], $_GET["genres"]);
                } elseif (isset($_GET["authors"])) {
                    $books = get_unique_books($_SESSION['user']['id'], $_GET["authors"], []);
                } else {
                    $books = get_unique_books($_SESSION['user']['id'], [], []);
                }
                $num = count($books);
                shuffle($books);
                if ($num > 5) {
                    $num = 5;
                }
                $res = '';
                for ($i = 0; $i < $num; $i++) {
                    $authors = get_authors_by_book_id($books[$i]['id']);
                    $num2 = count($authors);
                    $authors_res = 'Авторы: ';
                    for ($j = 0; $j < $num2; $j++) {
                        if ($j == $num2 - 1) {
                            $authors_res .= $authors[$j]["name"] . " " . $authors[$j]["surname"];
                        } else {
                            $authors_res .= $authors[$j]["name"] . " " . $authors[$j]["surname"] . ', ';
                        }
                    }
                    $res .= generate_book($books[$i]['title'], $authors_res, $books[$i]['id']);
                }
                if (!empty($res)) {
                    echo $res;
                } else {
                    echo "<div class='text-white'>По вашему запросу ничего не найдено. Попробуйте выбрать другие критерии для поиска или вовсе не выбирать их.</div>";
                }
            } catch (Exception $e){
                echo "<div class='text-white'>Непредвиденная ошибка!</div>";
            }
            ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
