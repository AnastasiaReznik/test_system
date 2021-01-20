<h1 style='text-align:center'>Список всех опросов</h1>
<a type="button" href="?add_test=true" class="btn btn-info" style="margin: 20px 0">Добавить опрос</a>
<?php
$stmt = $db->prepare("SELECT * FROM survey");
$stmt->execute();
$allTest = $stmt->fetchAll(\PDO::FETCH_ASSOC);

// include 'db_connect.php';
// var_dump($db);
// $countTestOnPage = 2; //количество опросов на странице
// $from = ($numPage - 1) * $countTestOnPage; //с какого эл-та выводить на стр
// 1 стр - запрос LIMIT 0,3
// 2 стр - запрос LIMIT 3,3
// 3 стр - запрос LIMIT 6,3


$countTestOnPage = 2; //количество опросов на странице

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
// var_dump($res);

foreach ($testsOnPage as $value) {
    // echo 
  
      "<div class=\"list-group list-group-horizontal\">
      <a href=\"?test={$value['id']}\" class=\"list-group-item list-group-item-action\">{$value['name']}</a>
      <a href=\"#\" class=\"list-group-item list-group-item-action\">Редактировать</a>
      <a href=\"#\" class=\"list-group-item list-group-item-action\">Результат</a>
      </div>
      ";
  }
  
  
?>