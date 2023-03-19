<?php
include('components/header.php');
include('components/pagination.php');
include('components/book_in_list.php');
include('utils.php');
session_start();
setPage("my_books");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Мои книги</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php
    echo generate_header();
    ?>
    <div class="container mt-5">
        <h1>Мои книги</h1>
        <div class="card-deck">
            <?php
                echo generate_book("Книга 1", "Имя автора", 2022, "1 апреля 2023 г.");
            ?>
            <?php
                echo generate_book("Книга 2", "Имя автора2", 2021, "15 апреля 2023 г.");
            ?>
            <?php
                echo generate_book("Книга 3", "Имя автора3", 2020, "14 апреля 2023 г.");
            ?>
        </div>
        <?php
            echo generate_pagination();
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>