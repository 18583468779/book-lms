<?php
// 获取图书申请列表接口
header('Content-Type:text/html;charset=utf8');

include('../db.php');

use Database\DB;

try {
    $db = new DB($config);
    $rows = $db->table('borrow')->get();
    echo  json_encode(["data" => $rows, "code" => 0, "msg" => "获取申请图书"]);
} catch (PDOException $e) {
    die($e->getMessage());
}
