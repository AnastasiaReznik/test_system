<?php
require 'db_connect.php';
require 'funcs.php';
if (isset($_POST['successAnswer']) AND isset($_POST['errorAnswer']) AND isset($_POST['idTest'])) {
    //   echo 'ajaxGO!';
    if($_POST['successAnswer'] >= 3) { 
        $field= 'success';
    } else {
        $field= 'fail';
    }
    $res = addResultTest($field, $_POST['idTest']);
    echo json_encode($res);
  }