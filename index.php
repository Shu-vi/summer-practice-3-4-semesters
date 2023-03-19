<?php
include('components/header.php');
include('components/pagination.php');
include('components/dropdown.php');
include('components/book_as_card.php');
include('utils.php');
session_start();
setPage("index");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Главная страница</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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
                <form>
                    <?php
                        $ar = ["Значение 1", "Значение 2"];
                        echo generate_dropdown("Фильтр 1", $ar);
                    ?>
                    <button type="submit" class="btn btn-primary">Применить фильтры</button>
                </form>
            </div>
            <!--FILTERS FINISH-->
            <!--BOOKS START-->
            <div class="col-md-9">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                        echo generate_book("Книга 1", "Автор 1", "https://via.placeholder.com/300x400.png")
                    ?>
                    <?php
                    echo generate_book("Книга 12", "Автор 2", "https://via.placeholder.com/300x400.png")
                    ?>
                    <?php
                    echo generate_book("Книга 2", "Автор 12", "https://via.placeholder.com/300x400.png")
                    ?>
                </div>
                <?php
                    echo generate_pagination();
                ?>
            </div>
        </div>
        <!--CONTENT FINISH-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>