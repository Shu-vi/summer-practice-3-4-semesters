<?php

function generate_checkbox($genres, $name)
{
    $num = count($genres);
//    for ($i = 0; $i < $num; $i++) {
//        $genres[$i] = $genres[$i]["title"];
//    }
    $res = "";
    for ($i = 0; $i < $num; $i++) {
        $res .= "<div class=\"form-check\">
            <input class=\"form-check-input\" type=\"checkbox\" value=\"".$genres[$i]["title"]."\" name='$name' id=\"".$genres[$i]["id"]."\">
            <label class=\"form-check-label\" for=\"".$genres[$i]["id"]."\">
            ".$genres[$i]["title"]."
            </label>
        </div>";
    }
    return $res;
}
?>