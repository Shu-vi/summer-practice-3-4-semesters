<?php
include('components/header.php');
include('components/need_auth.php');
include('utils.php');
session_start();
set_page("admin");
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
if (!isset($_SESSION["user"]) || $_SESSION['user']['role'] != 'ADMIN'){
    echo get_need_auth_block();
    exit();
}
?>
<?php
echo generate_header();
?>
<div class="container mt-5 col-5">
    <h1>Админка</h1>
    <!-- Выдача книги -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Дать книгу
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Выдать книгу</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="admin.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Id пользователя</label>
                            <input type="number" class="form-control" id="user_id" name="user_id">
                        </div>
                        <div class="mb-3">
                            <label for="book_id" class="form-label">Id книги</label>
                            <input type="number" class="form-control" id="book_id" name="book_id">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Крайняя дата сдачи книги(в формате гггг-мм-дд)</label>
                            <input type="text" class="form-control" id="date" name="date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary">Выдать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Принять книгу -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#take_book">
        Принять книгу
    </button>

    <!-- Modal -->
    <div class="modal fade" id="take_book" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Принять книгу</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="admin.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Id пользователя</label>
                            <input type="number" class="form-control" id="user_id" name="user_id">
                        </div>
                        <div class="mb-3">
                            <label for="book_id" class="form-label">Id книги</label>
                            <input type="number" class="form-control" id="book_id" name="book_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary">Принять</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Добавить книгу -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new_book">
        Добавить книгу
    </button>

    <!-- Modal -->
    <div class="modal fade" id="new_book" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Добавить книгу</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="admin.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Название</label>
                            <input type="text" class="form-control" id="user_id" name="user_id">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Дата написания книги(в формате гггг-мм-дд)</label>
                            <input type="text" class="form-control" id="date" name="date">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Количество страниц</label>
                            <input type="text" class="form-control" id="date" name="date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Добавить Жанр -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new_ganre">
        Добавить жанр
    </button>

    <!-- Modal -->
    <div class="modal fade" id="new_ganre" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Добавить жанр</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="admin.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="ganre" class="form-label">Название</label>
                            <input type="text" class="form-control" id="ganre" name="ganre">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Добавить автора -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new_author">
        Добавить автора
    </button>

    <!-- Modal -->
    <div class="modal fade" id="new_author" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Добавить автора</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="admin.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="ganre" class="form-label">Фамилия</label>
                            <input type="text" class="form-control" id="ganre" name="ganre">
                        </div>
                        <div class="mb-3">
                            <label for="ganre" class="form-label">Имя</label>
                            <input type="text" class="form-control" id="ganre" name="ganre">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Добавить книге жанр -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new_genre_book">
        Добавить книге жанр
    </button>

    <!-- Modal -->
    <div class="modal fade" id="new_genre_book" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Добавить книге жанр</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="admin.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="ganre" class="form-label">Id книги</label>
                            <input type="number" class="form-control" id="ganre" name="ganre">
                        </div>
                        <div class="mb-3">
                            <label for="ganre" class="form-label">Id жанра</label>
                            <input type="number" class="form-control" id="ganre" name="ganre">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Добавить книге автора -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new_author_book">
        Добавить книге автора
    </button>

    <!-- Modal -->
    <div class="modal fade" id="new_author_book" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Добавить книге автора</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="admin.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="ganre" class="form-label">Id книги</label>
                            <input type="number" class="form-control" id="ganre" name="ganre">
                        </div>
                        <div class="mb-3">
                            <label for="ganre" class="form-label">Id автора</label>
                            <input type="number" class="form-control" id="ganre" name="ganre">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
