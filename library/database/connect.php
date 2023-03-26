<?php
function get_connection(){
    return mysqli_connect('mysql', 'root', 'root', 'library');
}
?>