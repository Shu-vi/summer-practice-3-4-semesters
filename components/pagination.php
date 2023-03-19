<?php

function generate_pagination()
{
    return "
                <nav aria-label=\"...\">
                    <ul class=\"pagination mt-3\">
                        <li class=\"page-item disabled\">
                            <a class=\"page-link\" href=\"#\" tabindex=\"-1\" aria-disabled=\"true\">Предыдущая</a>
                        </li >
                        <li class=\"page-item active\" aria - current = \"page\" >
                            <a class=\"page-link\" href = \"#\" > 1</a >
                        </li >
                        <li class=\"page-item\" >
                            <a class=\"page-link\" href =\"#\" > 2</a >
                        </li >
                        <li class=\"page-item\" >
                            <a class=\"page-link\" href = \"#\" > 3</a >
                        </li >
                        <li class=\"page-item\" >
                            <a class=\"page-link\" href = \"#\" > Следующая</a >
                        </li >
                    </ul >
                </nav >
";
}
?>
