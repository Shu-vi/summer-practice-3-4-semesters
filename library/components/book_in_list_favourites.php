<?php

function generate_book($id, $title, $date, $page_count, $free_count){
    if (isset($_POST[$id."_favourites_delete"])){
        delete_from_favourites_by_user_id_and_book_id($_SESSION['user']['id'], $id);
        header('Location: /library/favourites.php');
    }
    return "
        <div class=\"card bg-dark text-light mb-5\">
            <div class=\"card-header\">
                <h5 class=\"card-title\">$title</h5>
            </div>
            <div class=\"card-body\">
                <p class=\"card-text\">Количество страниц: $page_count</p>
                <p class=\"card-text\">Год написания книги: $date</p>
                <p class=\"card-text\">Сейчас в библиотеке есть: $free_count таких книг</p>
            </div>
            <form class='card-footer' method='post' action=''>
                <button type='submit' class='btn btn-secondary btn-lg' name='".$id."_favourites_delete'>Удалить</button>
            </form>
        </div>
    ";
}

?>