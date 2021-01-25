<?php
require 'db_connect.php';
require 'funcs.php';
if (!isset($_GET) OR empty($_GET) OR isset($_GET['page'])) {
  require_once 'listTests.php';
} 
if (isset($_GET['add_test']) AND $_GET['add_test'] == 'true') {
  require_once 'add_test.php';
}
if (isset($_GET['test']) AND !empty($_GET['test'])) {
  require_once 'goTest.php';
}
if (isset($_GET['result']) AND !empty($_GET['result'])) {
  require_once 'resultTest.php';
}
if (isset($_GET['edit']) AND !empty($_GET['edit'])) {
  require_once 'edit.php';
}
//проверка наличия гет параметров в url 
// $urlGet = $_SERVER['QUERY_STRING'];
// parse_str($urlGet, $get);
// print_r($get); 
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
 <nav aria-label="Page navigation example">
  <ul class="pagination">
   <?php 
    for ($i=1; $i <= $countPage ; $i++) { 
    echo 
    "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=$i\">$i</a></li>";
    }
  ?>
  </ul>
</nav>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>



