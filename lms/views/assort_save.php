<?php
// 保存分类接口
header('Content-Type:text/html;charset=utf8');

include('../db.php');

use Database\DB;

try {
    $db = new DB($config);
    $assortname = trim($_POST['assortname']);
    $other = trim($_POST['other']);
    $id = $_POST['id'];
    if (empty($id)) {
        // 新增分类
        $db->table('assort')->insert(["assort_name" => $assortname, "other" => $other]);
        echo  json_encode(["data" => [], "flag" => 0, "msg" => "分类新增成功"]);
    } else {
        // 编辑分类
        $db->table('assort')->where("id = '{$id}'")->update(["assort_name" => $assortname, "other" => $other]);
        echo  json_encode(["data" => [], "flag" => 0, "msg" => "分类修改成功"]);
    }
} catch (PDOException $e) {
    die($e->getMessage());
}
