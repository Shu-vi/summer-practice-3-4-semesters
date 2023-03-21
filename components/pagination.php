<?php

function generate_pagination($total_elements, $current_page = 1, $elements_on_one_page = 9)
{
    $pages_count = ceil($total_elements / $elements_on_one_page);
    $prev = "";
    $next = "";
    if ($current_page == 1) {
        $prev = "disabled";
    }
    if ($current_page == $pages_count) {
        $next = "disabled";
    }
    return "
                <nav aria-label=\"...\">
                    <ul class=\"pagination mt-3\">
                        <li class=\"page-item $prev\">
                            <a class=\"page-link\" href= \"/library/index.php/?page=".($current_page-1)."\" tabindex=\"-1\" aria-disabled=\"true\">Предыдущая</a>
                        </li >
                        <li class=\"page-item active\" aria-current = \"page\" >
                            <a class=\"page-link\" href = '' >$current_page</a >
                        </li>
                        <li class=\"page-item $next\">
                            <a class=\"page-link\" href = \"/library/index.php/?page=".($current_page+1)."\"> Следующая</a >
                        </li >
                    </ul >
                </nav >
";
}

?>
<?php
if (isset($_GET['prev_button'])) {
    $_SESSION['current_page'] -= 1;
}
?>
