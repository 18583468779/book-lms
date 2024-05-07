<?php
header('Content-Type:text/html;charset=utf8');

include('db.php');

use Database\DB;

try {
    $db = new DB($config);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    if (!empty($_POST['real_name'])) {
        $real_name = $_POST['real_name'];
    }
    $rows = $db->table('user')->field('password')->where("username = '{$username}'")->get();

    if (empty($rows)) {
        $db->table('user')->insert(["username" => $username, "password" => $password, "real_name" => $real_name]);
        echo json_encode(['data' => [], 'flag' => 0, 'msg' => '恭喜你，注册成功！']);
    } else {
        echo json_encode(['data' => empty($rows), 'flag' => 1, 'msg' => '该账号已注册！']);
    }
} catch (PDOException $e) {
    die($e->getMessage());
}
