<?php
function setPage($page){
    $_SESSION["auth"] = null;
    $_SESSION["index"] = null;
    $_SESSION["my_books"] = null;
    $_SESSION["registr"] = null;
    $_SESSION["predict"] = null;
    $_SESSION[$page] = true;
}