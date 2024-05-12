<?php
include('../db.php');

use Database\DB;

$db = new DB($config);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>图书管理系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../layui/css/layui.css" rel="stylesheet">
    <link href="../static/style.css" rel="stylesheet">
</head>

<body>
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <div class="layui-logo layui-hide-xs layui-bg-black">图书管理系统</div>
            <!-- 头部区域-->
            <ul class="layui-nav layui-layout-left">
                <li class="layui-nav-item layui-hide-xs"><a href="index.php">首页</a></li>
            </ul>
            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item layui-hide-xs"><a href="../logout.php">退出登陆</a></li>
                <li class="layui-nav-item layui-hide layui-show-md-inline-block">
                    <a href="javascript:;">
                        个人中心
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="mine_info_list.php">个人信息</a></dd>
                        <dd><a href="mine_borrow_new.php">借阅申请</a></dd>
                        <dd><a href="mine_borrow_list.php">申请列表</a></dd>
                        <dd><a href="mine_book_list.php">我的书籍</a></dd>
                    </dl>
                </li>
            </ul>

        </div>
        <div class="layui-side layui-bg-black">
            <div class="layui-side-scroll">
                <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
                <ul class="layui-nav layui-nav-tree" lay-filter="test">
                    <li class="layui-nav-item layui-nav-itemed">
                        <a class="" href="javascript:;">图书管理</a>
                        <dl class="layui-nav-child">
                            <dd><a href="book_list.php">图书列表</a></dd>
                            <dd><a href="javascript:;">借阅管理</a></dd>
                            <dd><a href="javascript:;">损坏管理</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">分类管理</a>
                        <dl class="layui-nav-child">
                            <dd><a href="assort_list.php">分类列表</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">位置管理</a>
                        <dl class="layui-nav-child">
                            <dd><a href="position_list.php">位置列表</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">借阅管理</a>
                        <dl class="layui-nav-child">
                            <dd><a href="javascript:;">申请列表</a></dd>
                            <dd><a href="javascript:;">归还书籍</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">用户管理</a>
                        <dl class="layui-nav-child">
                            <dd><a href="javascript:;">用户列表</a></dd>
                            <dd><a href="javascript:;">新增用户</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">权限管理</a>
                        <dl class="layui-nav-child">
                            <dd><a href="javascript:;">权限列表</a></dd>
                            <dd><a href="javascript:;">修改权限</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </div>