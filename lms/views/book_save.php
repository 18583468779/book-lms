<?php
// 保存分类接口
header('Content-Type:text/html;charset=utf8');

include('../db.php');

use Database\DB;

try {
    $db = new DB($config);
    $book_name = trim($_POST['book_name']);
    $book_assort = trim($_POST['book_assort']);
    $book_position = trim($_POST['book_position']);
    $book_num = trim($_POST['book_num']);
    $id = $_POST['id'];
    if (empty($id)) {
        // 新增
        $db->table('book')->insert(["book_name" => $book_name, "book_assort" => $book_assort, "book_position" => $book_position, "book_num" => $book_num]);
        echo  json_encode(["data" => [], "flag" => 0, "msg" => "图书新增成功"]);
    } else {
        // 编辑
        $db->table('book')->where("id = '{$id}'")->update(["book_name" => $book_name, "book_assort" => $book_assort, "book_position" => $book_position, "book_num" => $book_num]);
        echo  json_encode(["data" => [], "flag" => 0, "msg" => "图书修改成功"]);
    }
} catch (PDOException $e) {
    die($e->getMessage());
}
