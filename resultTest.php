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
<h1>Результаты</h1>
<?php 
require_once 'db_connect.php';
require_once 'funcs.php';
$urlGet = $_SERVER['QUERY_STRING'];
parse_str($urlGet, $get);
// debug($get['result']);
$resQuery = queryAll($db,'survey', 'id', $get['result']);
// debug($resQuery);
?>
<p>Пройдено успешно:<?= $resQuery[0]['success'] ?></p>
<p>Пройдено не успешно:<?= $resQuery[0]['fail'] ?></p>
<a class="btn btn-primary" href="/" >На главную</a>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>