<?php

function generate_dropdown($title, $values, $name){
    $num = count($values);
//    for ($i = 0; $i < $num; $i++){
//        $values[$i] = $values[$i]["surname"];
//    }
    $options = '';
    for ($i = 0; $i < $num; $i++){
        $options .= "<option value=\""
            .$values[$i]['id']
            ."\">"
            .$values[$i]['surname']
            .' '
            .$values[$i]['name']."</option>";

    }
    return "
        <div class=\"mb-3\">
            <label for=\"$title\" class=\"form-label\">$title</label>
            <select class=\"form-select\" id=\"$title\" name='$name'>
                <option selected>Выберите значение</option>
                $options
            </select>
        </div>
    ";
}


?>