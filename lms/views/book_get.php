<?php
// 获取分类接口
header('Content-Type:text/html;charset=utf8');

include('../db.php');

use Database\DB;

try {
    $db = new DB($config);
    $rows = $db->table('book')->get();
    echo  json_encode(["data" => $rows, "code" => 0, "msg" => "获取所有图书"]);
} catch (PDOException $e) {
    die($e->getMessage());
}
