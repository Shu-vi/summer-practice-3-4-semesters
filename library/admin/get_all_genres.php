<?php
include('../components/header.php');
include('../components/need_auth.php');
include('../utils.php');
include('../components/admin_bar.php');
include('../database/database.php');
session_start();
set_page("admin");

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Админка</title>
</head>
<body>
<?php
if (!isset($_SESSION["user"]) || $_SESSION['user']['role'] != 'ADMIN') {
    echo get_need_auth_block();
    exit();
}
?>
<?php
echo generate_header();
?>
<div class="container mt-5">
    <?php
    echo get_admin_links();
    ?>
    <div class="row">
        <div class="col-md-12">
            <h1>Список жанров</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Наименование жанра</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $genres = get_all_genres();
                $num = count($genres);
                $res = '';
                if ($num > 0) {
                    foreach ($genres as $genre){
                        $res .= '
                                <tr>
                                    <td>'.$genre['id'].'</td>
                                    <td>'.$genre['title'].'</td>
                                </tr>
                                ';
                    }
                    echo $res;
                } else {
                    echo "Список пуст.";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
