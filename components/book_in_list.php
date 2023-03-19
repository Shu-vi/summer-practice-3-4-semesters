<?php
function generate_book($title, $authors, $date, $deadline){
    return "
        <div class=\"card bg-dark text-light mb-5\">
            <div class=\"card-header\">
                <h5 class=\"card-title\">$title</h5>
            </div>
            <div class=\"card-body\">
                <p class=\"card-text\">Авторы: $authors</p>
                <p class=\"card-text\">Год написания книги: $date</p>
                <p class=\"card-text\">Крайний срок возврата книги в библиотеку: $deadline</p>
            </div>
        </div>
    ";
}

?>