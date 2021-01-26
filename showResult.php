<?php 
require_once 'db_connect.php';
require_once 'funcs.php';
require_once 'config.php';
if (!empty($_GET)) {
    $res_check_get = checkIssetGet($arr_get, $db);
    if ($res_check_get == 'true') {
        header("Location: showResult.php?result_id=" . $_GET['result_id']);
        die();
    }
} else {
    header("Location: index.php");
}
// запрос к бд - отразить по id из гет кол-во правильных и не правильных ответов
$id_test = $_GET['result_id']; //id теста которого надо тобразить  рез-ты
$test = queryAll($db, 'survey', 'id', $_GET['result_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Главная</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
<h1>Результат теста: <?=$test[0]['name'] ?> </h1>
<div class="alert alert-success result" role="alert">Правильных ответов: <?= $test[0]['count_correct_answer']; ?> </div>
<div class="alert alert-danger result-uncor" role="alert">Неправильных ответов: <?= $test[0]['count_errors_answer']; ?> </div>
<div class="alert alert-light" role="alert">Ваш результат:
<?php if ( $test[0]['count_correct_answer'] >= $test[0]['count_errors_answer']) : ?>
Тест успешно пройден!
<?php else : ?>
Тест не пройден!
<?php endif; ?>
</div>
<a class="btn btn-primary" href="/" >На главную</a>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>

<?php

?>