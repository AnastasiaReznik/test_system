<?php
require 'db_connect.php';
require_once 'funcs.php';
require_once 'config.php';
if (!empty($_GET) AND (!isset($_GET['page']))) {
  header("Location: index.php");
}
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
<h1 style='text-align:center'>Список всех опросов</h1>
<a type="button" href="add_test.php" class="btn btn-warning" style="margin: 20px 0">Добавить опрос</a>
<?php
$allTest = queryAll($db,'survey');
// пагинация
$countNotes = count($allTest);
$countPage = ceil($countNotes/$countTestOnPage); //количество страниц
if (isset($_GET['page']) AND is_numeric($_GET['page']))  {
  $numPage = $_GET['page']; //гет-запрос, в кот номер страницы
  $from = ($numPage - 1) * $countTestOnPage; //с какого эл-та выводить на стр
} else {
  $from = 0; //с какого эл-та выводить на стр
}
$stmt = $db->prepare("SELECT * FROM survey LIMIT $from, $countTestOnPage");
$stmt->execute();
$testsOnPage = $stmt->fetchAll(\PDO::FETCH_ASSOC); //записи кот нужно вывести на стр
// debug($testsOnPage);
?>
<?php foreach ($testsOnPage as $value) : ?>
      <div class="list-group list-group-horizontal">
      <a href="goTest.php?test=<?=$value['id']?>" class="list-group-item list-group-item-action"><?=$value['name'] ?></a>
      <a href="edit.php?edit=<?=$value['id']?>" class="list-group-item list-group-item-action">Редактировать</a>
      <a href="resultTest.php?result=<?=$value['id']?>" class="list-group-item list-group-item-action">Результат</a>
      </div>
<?php endforeach; ?>
<?php if ($countPage > 1) : ?>
 <nav aria-label="Page navigation example">
  <ul class="pagination">
   <?php for ($i=1; $i <= $countPage ; $i++) : ?>   
      <li class="page-item"><a class="page-link" href="?page=<?=$i?>"><?= $i ?></a></li>
      <?php endfor; ?>
  </ul>
</nav>
<?php endif; ?>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>

