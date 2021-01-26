<?php
require 'db_connect.php';
// require_once 'config.php';
function debug($data)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
}
function checkIssetGet(&$arr_get, &$db)
{
    $urlGet = $_SERVER['QUERY_STRING'];
    parse_str($urlGet, $get_url);
    // debug($get_url);
    foreach ($arr_get as $k => $getParam) {
        // echo $get_url[$getParam];
        if (isset($get_url[$getParam])) {
            $name_get = $get_url[$getParam];
           if (empty($name_get)) {
             header("Location:" . $_SERVER['PHP_SELF']);
           } else { //если не пустой- запрос в бд
             $id_test_from_get =  $get_url[$getParam];
             $check_isset_test = queryAll($db,'survey', 'id', $id_test_from_get);
             if (empty($check_isset_test)) {
              header("HTTP/1.0 404 Not Found");
              die();
             }
           }
          $notFoungGet = 'false';
          break;
        }  else {
            $notFoungGet='true';
        }
      }
      return $notFoungGet;
}
function queryAll(&$db,$table_name, $param = null, $param_value = null)
//"SELECT * FROM {$table_name} WHERE {$param_name} = ?"
{
    // global $db;
    if ($param != null and $param_value != null) {
    $stmt = $db->prepare("SELECT * FROM {$table_name} WHERE {$param} = ?");
    } else {
        $stmt = $db->prepare("SELECT * FROM {$table_name}");
    }
    $stmt->execute([$param_value]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    // debug($stmt);
}

function addResultTest(&$db,$field, $id_test)
{
    // global $db;
    $stmt = $db->prepare("UPDATE survey SET {$field} = {$field}+1 WHERE `id` = ?"); 
    return $stmt->execute([$id_test]);
    // return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

function addTest(&$db,$newTest)
{
    $nameTest = $newTest['nameTest'];
    $stmt = $db->prepare("INSERT INTO survey (`name`) VALUES (?)"); 
    $res = $stmt->execute([$nameTest]);
    $id_test = $db->lastInsertId(); //id новго теста
    if ($res == 1) {
        // вставка вопросов и ответов в бд
            foreach ($newTest as $key => $value) {
                // вставка впоросов в бд
                    if(stristr($key, 'question') !== false) {
                        // echo $value; //вопросы для вставки в бд
                        $stmt = $db->prepare("INSERT INTO questions (`questions`, `id_survey`) VALUES (?, ?)"); 
                        $res_insert_question = $stmt->execute([$value, $id_test]);
                        if ($res_insert_question == 0) { //если не добавлен вопрос
                            return 'false';
                            break;
                        } 
                    } 
                    // поиск правильного ответа
                        $current = current($newTest);
                        $next = next($newTest);
                        if (stristr($key, 'answer') !== false) { //елси дальше ответ
                            $substr_id = substr($key, -1); //id вопроса
                            $stmt = $db->prepare("INSERT INTO answer (`answer`, `correct_answer`, `id_question`, `id_survey`) VALUES (?, ?, ?,?)");
                            if ($next == 'on') {
                                if ($value == $current) {
                                    $res_insert_answer = $stmt->execute([$value, '1', $substr_id, $id_test]);
                                } 
                            }  else {
                                $res_insert_answer = $stmt->execute([$value, '0', $substr_id, $id_test]);
                            if ($res_insert_answer ==1 ) {
                                // echo 'вопрос добавлен';
                                // return 'true';
                                $res_insert = 'true';
                            } else {
                                return 'false';
                            }
                        }
            }
        } 
} else {
    return 'false';
}
 if ($res_insert) {
     return 'true';
 } else {
     return 'false';
 }
}

function updateTest(&$db,$dataTest)
{
    // global $db;
    $nameTest = $dataTest['nameTestEdit']; //имя теста
    $stmt = $db->prepare("UPDATE survey SET `name` = ? WHERE `id` = ?"); 
    $res = $stmt->execute([$nameTest, $_GET['edit']]);
    // $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    if ($res) {
        //обновить вопросы
        foreach ($dataTest as $key => $value) {
            if(stristr($key, 'nameQuestionEdit') !== false) {
            //    debug(stristr($key, 'nameQuestionEdit'));
                $id_question = substr($key,16);
                $stmt = $db->prepare("UPDATE questions SET `questions` = ? WHERE `id` = ?"); 
                // $stmt = $db->prepare("UPDATE questions SET `questions` = ? WHERE `id` = ?"); 
                $res_update_question = $stmt->execute([$value, $id_question]);
                if (!$res_update_question) {
                    return 'false';
                };
            }  
            
            $current = current($dataTest);
            $next = next($dataTest);
            if (stristr($key, 'answer') !== false) {
                $id_answer = substr($key,6);
                $stmt = $db->prepare("UPDATE answer SET `answer` = ?, `correct_answer` = ? WHERE `id` = ?"); 
                if ($next == 'on') { 
                    $res_update_answer = $stmt->execute([$value, '1',$id_answer]);
                    
                }  else {
                    $res_update_answer = $stmt->execute([$value, '0',$id_answer]);
            }
            if (!$res_update_answer) {
                return 'false';
            } else {
                $res_update = 'true';
            }
            }
        }
    } else {
        return 'false';
        }
        return $res_update;
} 
?>