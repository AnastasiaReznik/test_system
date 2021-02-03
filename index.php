<?php
require 'db_connect.php';
require_once 'funcs.php';
require_once 'config.php';
$allTest = queryAll($db,'survey');
// пагинация
$countNotes = count($allTest);
$countPage = ceil($countNotes/$countTestOnPage); //количество страниц
// $re = str_replace(['.','/'], '', $_GET['page']);
if (isset($_GET['page']) AND !empty($_GET['page']) AND is_numeric($_GET['page']) AND $_GET['page']>=1 AND $_GET['page']<=$countPage)  {
  $numPage = $_GET['page']; //гет-запрос, в кот номер страницы
  $from = ($numPage - 1) * $countTestOnPage; //с какого эл-та выводить на стр
} else if (!isset($_GET['page']) OR empty($_GET['page'])) {
  $from = 0; //с какого эл-та выводить на стр
} else if(isset($_GET['page']) AND !empty($_GET['page']) AND  is_numeric($_GET['page']) AND $_GET['page']>=$countPage) {
  header("HTTP/1.0 404 Not Found");
  die();
} else {
  header("HTTP/1.0 404 Not Found");
  die();
}
$page = 'Главная';
require_once 'header.php'; 
$stmt = $db->prepare("SELECT * FROM survey LIMIT $from, $countTestOnPage");
$stmt->execute();
$testsOnPage = $stmt->fetchAll(\PDO::FETCH_ASSOC); //записи кот нужно вывести на стр
// debug($testsOnPage);
?>
<h1 style='text-align:center'>Список всех опросов</h1>
<a type="button" href="add_test.php" class="btn btn-warning" style="margin: 20px 0">Добавить опрос</a>
<?php foreach ($testsOnPage as $value) : ?>
      <div class="list-group list-group-horizontal">
      <a href="goTest.php?test=<?= htmlspecialchars($value['id'], ENT_QUOTES,'utf-8')?>" class="list-group-item list-group-item-action"><?= htmlspecialchars($value['name'], ENT_QUOTES,'utf-8') ?></a>
      <a href="edit.php?edit=<?= htmlspecialchars($value['id'], ENT_QUOTES,'utf-8')?>" class="list-group-item list-group-item-action">Редактировать</a>
      <a href="resultTest.php?result=<?= htmlspecialchars($value['id'], ENT_QUOTES,'utf-8')?>" class="list-group-item list-group-item-action">Результат</a>
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
<?php require_once 'footer.php'; ?>

