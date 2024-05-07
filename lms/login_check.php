<?php
header("Content-Type:text/html;charset=utf8");
include('db.php');

use Database\DB;

try {
    $db = new DB($config);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rows = $db->table('user')->field('password')->where("username = '{$username}'")->get();
    if (!empty($rows)) {
        if ($rows[0]['password'] === $password) {
            setcookie('username', $username, time() + 60 * 60);
            echo json_encode(['data' => $rows[0]['password'], 'flag' => 0, 'msg' => '登录成功！']);
        } else {
            echo json_encode(['data' => [], 'flag' => 1, 'msg' => '密码错误！']);
        }
    } else {
        echo json_encode(['data' => empty($rows), 'flag' => 1, 'msg' => '该账号未注册！']);
    }
} catch (PDOException $e) {
    die($e->getMessage());
}
