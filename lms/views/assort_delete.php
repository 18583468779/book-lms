<?php
// 删除分类接口
header('Content-Type:text/html;charset=utf8');

include('../db.php');

use Database\DB;

try {
    $db = new DB($config);
    $id = $_POST['id'];
    $rows = $db->table('assort')->where("id = '{$id}'")->delete();
    echo json_encode(["data" => $rows, "code" => 0, "msg" => "删除成功"]);
} catch (PDOException $e) {
    die($e->getMessage());
}
