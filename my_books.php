<?php
include('components/header.php');
include('components/pagination.php');
include('components/book_in_list.php');
include('utils.php');
include('database/database.php');
include('components/need_auth.php');
session_start();
set_page("my_books");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Мои книги</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
    <h1>Мои книги</h1>
    <div class="card-deck">
        <?php
            $books = get_readable_books_by_user_id($_SESSION['user']['id']);
            $num = count($books);
            $res = '';
            if (isset($books) and $num > 0){
                for ($i = 0; $i < $num; $i++){
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
                    $res .= generate_book($books[$i]['title'], $authors_res, $books[$i]['date'], $books[$i]['deadline']);
                }
            } else {
                $res = 'Список пуст!';
            }
            echo $res;
        ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>