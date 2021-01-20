<!-- <h1>edfrtretret</h1> -->
<?php
// function addResultTest($id_test, $field)
// {
//     // $oldRes = queryOne($field, 'survey', 'id', $id_test );
//     $stmt = $db->prepare("UPDATE survey SET {$field} = '$field'+1 WHERE `id` = ?"); //"UPDATE users SET `email` = '$email', `firstName` = '$name', `lastName` = '$lastName', `sex` = '$sex', `birthdate` = '$birthday' WHERE `id` = '$id_user'");
//     $stmt->execute([$id_test]);
//     return $stmt->fetchAll(\PDO::FETCH_ASSOC);
// }

// function queryOne($table_name, $field, $param1, $value1, $param2=null, $value2 = null,$param3 = null, $value3 = null) {
//     if ($param2 and $value2) {
//         $stmt = $this->db->prepare("SELECT {$field} FROM {$table_name} WHERE {$param1} = ? AND  {$param2} = ?");
//         $stmt->execute([$value1, $value2]);
//     } else if ($param3 and $value3) {
//         $stmt = $this->db->prepare("SELECT {$field} FROM {$table_name} WHERE {$param1} = ? AND  {$param2} = ? AND {$param3} = ?");
//         $stmt->execute([$value1, $value2, $value3]);
//     } else {
//         $stmt = $db->prepare("SELECT {$field} FROM {$table_name} WHERE {$param1} = ?");
//         $stmt->execute([$value1]);
//     }
//     return $stmt->fetch(\PDO::FETCH_ASSOC);
// }

function queryAll($table_name, $param = null, $param_value = null)
//"SELECT * FROM {$table_name} WHERE {$param_name} = ?"
{
    global $db;
    if ($param != null and $param_value != null) {
    $stmt = $db->prepare("SELECT * FROM {$table_name} WHERE {$param} = ?");
    } else {
        $stmt = $db->prepare("SELECT * FROM {$table_name}");
    }
    $stmt->execute([$param_value]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    // debug($stmt);
}
?>