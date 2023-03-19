<?php
include('components/header.php');
include('utils.php');
session_start();
setPage("predict");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Главная страница</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<?php
echo generate_header();
?>
<div class="card bg-dark text-white pt-5 pb-5 min-vh-100" style="padding: 0 200px 0 200px;">
    <div class="card-body mt-5">
        <h5 class="card-title">Рекомендации</h5>
        <form>
            <div class="mb-3">
                <label for="genre" class="form-label">Предпочитаемый жанр</label>
                <input type="text" class="form-control" id="genre">
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Предпочитаемый автор</label>
                <input type="text" class="form-control" id="author">
            </div>
            <button type="submit" class="btn btn-primary">Получить рекомендацию</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
