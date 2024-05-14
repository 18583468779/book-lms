<?php
include('header.php');
?>
<div class="layui-body">
    <div style="padding: 15px;">
        <h2>个人中心</h2>
        <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title">
                <li><a href="mine_info_list.php">个人信息</a></li>
                <li class="layui-this"><a href="mine_borrow_new.php">借阅申请</a></li>
                <li><a href="mine_borrow_list.php">申请列表</a></li>
                <li><a href="mine_book_list.php">我的书籍</a></li>
            </ul>
        </div>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div class="flex">
                    <form class="layui-form" method="post" action="assort_list_search.php">
                        <div class="layui-inline">
                            <input class="layui-input" name="search" style="width:350px" placeholder="按图书名称查找">
                        </div>
                        <button class="layui-btn layui-btn-normal" type="submit">搜索</button>
                    </form>
                </div>
                <div style="margin-top:30px">
                    <table class="layui-table" lay-filter="test"
                        lay-data="{url:'./book_get.php', page: true, limit: 6, limits:[6]}" id="ID-table-demo-theads-1">
                        <thead>
                            <tr>
                                <th lay-data="{field:'id'}" rowspan="2">ID</th>
                                <th lay-data="{field:'book_name'}" rowspan="2">图书名称</th>
                                <th lay-data="{field:'book_assort'}" rowspan="2">图书类型</th>
                                <th lay-data="{field:'book_position'}" rowspan="2">存放位置</th>
                                <th lay-data="{field:'book_num'}" rowspan="2">图书数量</th>
                                <th lay-data="{fixed: 'right', width: 160, align: 'center', toolbar: '#templet-demo-theads-tool'}"
                                    rowspan="2">操作</th>
                            </tr>
                            <script type="text/html" id="templet-demo-theads-tool">
                            <div class="layui-clear-space">
                                <a class="layui-btn layui-btn-xs" lay-event="edit">借阅</a>
                            </div>
                            </script>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>
<script>
function layerAlert(layer, util, form, title = "", url = 'mine_borrow_save.php', data = {
    id: '',
    book_name: '',
    book_assort: '',
    book_position: '',
    book_num: '',
}) {

    // 封装弹框
    layer.open({
        type: 1,
        area: ['520px', '420px'],
        resize: false,
        shadeClose: true,
        title,
        content: `
                        <form class="layui-form" >
                            <div class="layui-form" lay-filter="filter-test-layer" style="margin: 16px;">
                                <div class="demo-login-container">
                                <div class="layui-form-item" style="display:none">
                                        <label class="layui-form-label">id</label>
                                        <div class="layui-input-block">
                                        <input type="text" name="id"  placeholder="请输入" autocomplete="off" class="layui-input" value="${data.id}" >
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">图书名称*</label>
                                        <div class="layui-input-block">
                                        <input type="text" name="book_name" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" value="${data.book_name}" disabled>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">图书类型*</label>
                                        <div class="layui-input-block">
                                            <select name="book_assort" lay-filter="" lay-verify="required" id="book_assort" disabled>
                                                <option value=""></option>
                                                </select>
                                                </div>
                                                </div>
                                                <div class="layui-form-item">
                                                    <label class="layui-form-label">图书位置*</label>
                                                    <div class="layui-input-block">
                                                        <select name="book_position" lay-filter="" lay-verify="required" id="book_position" disabled>
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="layui-form-item">
                                                    <div class="layui-inline">
                                                        <label class="layui-form-label">图书数量*</label>
                                                        <div class="layui-input-inline" style="width: 100px;">
                                                            <input type="number" name="book_num" placeholder="" autocomplete="off" class="layui-input" min="1" step="1"
                                                                lay-affix="number" value="${data.book_num}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="layui-form-item">
                                                    <div class="layui-inline">
                                                        <label class="layui-form-label">借阅数量*</label>
                                                        <div class="layui-input-inline" style="width: 100px;">
                                                            <input type="number" name="borrow_num" lay-verify="required" placeholder="" autocomplete="off" class="layui-input" max="${data.book_num}" min="1" step="1"
                                                                lay-affix="number" value="1" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="layui-form-item">
                                                    <div class="layui-input-block">
                                                        <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">立即提交</button>
                                                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                                                    </div>
                                                </div>
                                                </div>
                                                </div>
                                                </form>
                                        `,
        success: function() {
            // 设置下来选项的数据，为什么用js处理是因为方便，option默认值的处理
            // 图书类型
            let assortArr = <?php echo json_encode($db->table('assort')->get()); ?>;
            assortArr.forEach(item => {
                let selected = data.book_assort === item.assort_name ? true : false;
                if (selected) {
                    $("#book_assort").append(
                        `<option value="${item.assort_name}" selected>${item.assort_name}</option>`
                    )
                } else {
                    $("#book_assort").append(
                        `<option value="${item.assort_name}">${item.assort_name}</option>`)
                }
            });
            // 图书位置
            let positionArr = <?php echo json_encode($db->table('position')->get()); ?>;
            positionArr.forEach(item => {
                let selected = data.book_position === item.position_name ? true : false;
                if (selected) {
                    $("#book_position").append(
                        `<option value="${item.position_name}" selected>${item.position_name}</option>`
                    )
                } else {
                    $("#book_position").append(
                        `<option value="${item.position_name}">${item.position_name}</option>`)
                }
            });

            // 对弹层中的表单进行初始化渲染
            form.render();
            // 表单提交事件
            form.on('submit(submit_btn)', function(data) {
                let field = data.field; // 获取表单字段值
                let entry_user = <?php echo json_encode($_COOKIE["username"])  ?>;
                let result = {
                    ...field,
                    book_id: field.id,
                    state: field.book_num - field.borrow_num, // 剩余的书籍数量
                    entry_user // 当前用户
                };
                delete result["id"];
                result["book_num"] = Number(result["book_num"]);
                $.ajax({
                    headers: {
                        Accept: "application/json; charset=utf-8"
                    },
                    url,
                    method: 'post',
                    data: result,
                    success: (res) => {
                        let data = JSON.parse(res);
                        layer.alert(data.msg, {
                            title: "提示"
                        });
                        if (data.flag === 0) {
                            setTimeout(() => {
                                window.location
                                    .reload();
                            }, 1000);
                        }
                    },
                    error: (e) => {
                        console.log('e', e)
                    }
                })
                return false; // 阻止默认 form 跳转
            });
        }
    });
};


layui.use('table', function(e) {
    var $ = layui.$;
    var layer = layui.layer;
    var util = layui.util;
    var form = layui.form;
    var table = layui.table;
    table.on('tool(test)', function(obj) {
        var tr = obj.data;
        let arr = Object.values(tr);
        var eventName = obj.event;
        if (tr.book_num == 0) {
            layer.msg('图书无库存', {
                icon: 0
            });
            return;
        }
        layerAlert(layer, util, form, "借阅", 'mine_borrow_save.php', tr);
    });
});
</script>