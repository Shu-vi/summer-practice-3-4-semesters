<?php

function get_admin_links(){
    return '
    <ul class="nav nav-pills justify-content-center">
        <li class="nav-item"><a class="nav-link" href="/library/admin/give_book.php">Выдать книгу</a></li>
        <li class="nav-item"><a class="nav-link" href="/library/admin/get_book.php">Принять книгу</a></li>
        <li class="nav-item"><a class="nav-link" href="/library/admin/create_book.php">Добавить книгу</a></li>
        <li class="nav-item"><a class="nav-link" href="/library/admin/create_book_genre.php">Добавить жанр книге</a></li>
        <li class="nav-item"><a class="nav-link" href="/library/admin/create_book_author.php">Добавить автора книге</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Показать всех авторов</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Показать все жанры</a></li>
    </ul>
';

}

?>