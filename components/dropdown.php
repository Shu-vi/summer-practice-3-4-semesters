<?php

function generate_dropdown($title, $values){
    $num = count($values);
    $options = '';
    for ($i = 0; $i < $num; $i++){
        $options .= "<option value=\"$i+1\">$values[$i]</option>";
    }
    return "
        <div class=\"mb-3\">
            <label for=\"$title\" class=\"form-label\">$title</label>
            <select class=\"form-select\" id=\"$title\">
                <option selected>Выберите значение</option>
                $options
            </select>
        </div>
    ";
}


?>