<?php
// 保存借阅书籍接口
header('Content-Type:text/html;charset=utf8');

include('../db.php');

use Database\DB;

try {
    $db = new DB($config);
    $book_name = trim($_POST['book_name']);
    $book_assort = trim($_POST['book_assort']);
    $book_position = trim($_POST['book_position']);
    $book_num = trim($_POST['book_num']);
    $borrow_num = trim($_POST['borrow_num']);
    $state = trim($_POST['state']);
    $entry_user = trim($_POST['entry_user']);
    $book_id = trim($_POST['book_id']);
    // 减少图书的数量
    $db->table('book')->where("id = '$book_id'")->update(["book_num" => $state]);
    // 借阅
    $db->table('borrow')->insert([
        "book_name" => $book_name, "book_assort" => $book_assort, "book_position" => $book_position,
        "book_num" => $state, "borrow_num" => $borrow_num, "state" => $state, "entry_user" => $entry_user, "book_id" => $book_id
    ]);
    echo  json_encode(["data" => [], "flag" => 0, "msg" => "图书借阅成功"]);
} catch (PDOException $e) {
    die($e->getMessage());
}
