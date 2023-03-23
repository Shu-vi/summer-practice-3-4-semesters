<?php


function generate_book($book, $authors, $genres)
{
    $add_to_favourite = '';
    if (isset($_SESSION['user'])){
        $favourite_book = get_favourites_books_by_user_id_and_book_id($_SESSION['user']['id'], $book['id']);
        if ($favourite_book == []){
            $add_to_favourite = "<div>
                    <form method=\"post\" action=\"\">
                        <input class='btn btn-dark' type=\"submit\" name=\"".$book['id']."_add_book\" value=\"Добавить в избранное\">
                    </form>
                </div>";
        }
        if (isset($_POST[$book['id']."_add_book"]) && $favourite_book == []){
            add_to_favourites($book['id'], $_SESSION['user']['id']);
            $add_to_favourite = '';
        }
    }

    return "
        <div class=\"col\">
            <div class=\"card h-100\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\">".$book['title'].' '.$book['date']."</h5>
                    <h5 class=\"card-text\">Id: ".$book['id']."</h5>
                    <p class=\"card-text\">$authors</p>
                    <p class=\"card-text\">$genres</p>
                </div>
                $add_to_favourite
            </div>
        </div>
    ";
}
?>
