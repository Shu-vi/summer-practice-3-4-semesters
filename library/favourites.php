<?php
include('components/header.php');
include('components/pagination.php');
include('components/book_in_list_favourites.php');
include('utils.php');
include('database/database.php');
include('components/need_auth.php');
session_start();
set_page("favourites");
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Избранное</title>
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
<div class="container mt-5">
    <h1>Избранное</h1>
    <div class="card-deck">
        <?php
        try {
            $books = get_favourites_books_by_user_id($_SESSION["user"]["id"]);
            $num = count($books);
            $res = '';
            if (isset($books) and $num > 0){
                for ($i = 0; $i < $num; $i++){
                    $res .= generate_book($books[$i]['id'], $books[$i]['title'], $books[$i]['date'], $books[$i]['pages_count'], $books[$i]['free_count']);
                }
            } else {
                $res = 'Список пуст!';
            }
            echo $res;
        } catch (Exception $e){
            echo "<div>Непредвиденная ошибка!</div>";
        }

        ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
