<?php
// 用户个人信息接口
header('Content-Type:text/html;charset=utf8');

include('../db.php');

use Database\DB;

try {
    $db = new DB($config);
    $username =  $_COOKIE['username'];
    $rows = $db->table('user')->where("username = '$username'")->get();
    echo  json_encode(["data" => $rows, "code" => 0, "msg" => "获取当前用户信息"]);
} catch (PDOException $e) {
    die($e->getMessage());
}
