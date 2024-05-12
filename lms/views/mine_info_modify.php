<?php
// 修改个人信息接口
header('Content-Type:text/html;charset=utf8');

include('../db.php');

use Database\DB;

try {
    $db = new DB($config);
    $id = trim($_POST["id"]);
    $password = trim($_POST["password"]);
    $real_name = trim($_POST["real_name"]);
    $rows = $db->table('user')->where("id = '$id'")->update(["password" => $password, "real_name" => $real_name]);
    echo  json_encode(["data" => $rows, "code" => 0, "msg" => "修改用户信息成功"]);
} catch (PDOException $e) {
    die($e->getMessage());
}
