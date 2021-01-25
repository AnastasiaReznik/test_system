<div class="container">
<h1 style='text-align:center'>Список всех опросов</h1>
<a type="button" href="?add_test=true" class="btn btn-warning" style="margin: 20px 0">Добавить опрос</a>
<?php
$allTest = queryOne('survey');
// пагинация
$countTestOnPage = 10; //количество опросов на странице

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

foreach ($testsOnPage as $value) {
    echo 
      "<div class=\"list-group list-group-horizontal\">
      <a href=\"?test={$value['id']}\" class=\"list-group-item list-group-item-action\">{$value['name']}</a>
      <a href=\"?edit={$value['id']}\" class=\"list-group-item list-group-item-action\">Редактировать</a>
      <a href=\"?result={$value['id']}\" class=\"list-group-item list-group-item-action\">Результат</a>
      </div>
      ";
  }
?>
</div>