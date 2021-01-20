<?php
include 'db_connect.php';
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

 function addResultTest($field, $id_test)
  {
    global $db;
    $stmt = $db->prepare("UPDATE survey SET {$field} = {$field}+1 WHERE `id` = ?"); 
    $stmt->execute([$id_test]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
      
  }