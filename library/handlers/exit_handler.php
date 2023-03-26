<?php

session_start();
session_destroy();
header('Location: /library/index.php');
?>