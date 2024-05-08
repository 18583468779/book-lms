<?php
// 获取位置接口
header('Content-Type:text/html;charset=utf8');

include('../db.php');

use Database\DB;

try {
    $db = new DB($config);
    $rows = $db->table('position')->get();
    echo  json_encode(["data" => $rows, "code" => 0, "msg" => "获取所有位置"]);
} catch (PDOException $e) {
    die($e->getMessage());
}
