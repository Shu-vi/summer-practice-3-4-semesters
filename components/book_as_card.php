<?php
function generate_book($title, $authors, $img)
{
    return "
        <div class=\"col\">
            <div class=\"card h-100\">
                <img src=\"$img\" class=\"card-img-top\" alt=\"...\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\">$title</h5>
                    <p class=\"card-text\">$authors</p>
                </div>
            </div>
        </div>
    ";
}
?>
