<?php
// 保存位置接口
header('Content-Type:text/html;charset=utf8');

include('../db.php');

use Database\DB;

try {
    $db = new DB($config);
    $positionname = trim($_POST['position_name']);
    $positionother = trim($_POST['position_other']);
    $id = $_POST['id'];
    if (empty($id)) {
        // 新增位置
        $db->table('position')->insert(["position_name" => $positionname, "position_other" => $positionother]);
        echo  json_encode(["data" => [], "flag" => 0, "msg" => "位置新增成功"]);
    } else {
        // 编辑位置
        $db->table('position')->where("id = '{$id}'")->update(["position_name" => $positionname, "position_other" => $positionother]);
        echo  json_encode(["data" => [], "flag" => 0, "msg" => "位置修改成功"]);
    }
} catch (PDOException $e) {
    die($e->getMessage());
}
