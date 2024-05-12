<?php
include('header.php');
?>
<div class="layui-body">
    <div style="padding: 15px;">
        <h2>个人中心</h2>
        <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title">
                <li class="layui-this">个人信息管理</li>
                <li>借阅申请</li>
                <li>申请列表</li>
                <li>我的书籍</li>
            </ul>
        </div>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div style="margin-top:30px">
                    <table class="layui-table" lay-filter="test" lay-data="{url:'./mine_info_get.php'}"
                        id="ID-table-demo-theads-1">
                        <thead>
                            <tr>
                                <th lay-data="{field:'id', width:180}" rowspan="2">ID</th>
                                <th lay-data="{field:'username'}" rowspan="2">用户名</th>
                                <th lay-data="{field:'real_name'}" rowspan="2">真实姓名</th>
                                <th lay-data="{field:'create_time'}" rowspan="2">创建时间</th>
                                <th lay-data="{fixed: 'right', width: 160, align: 'center', toolbar: '#templet-demo-theads-tool'}"
                                    rowspan="2">操作</th>
                            </tr>
                            <script type="text/html" id="templet-demo-theads-tool">
                            <div class="layui-clear-space">
                                <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
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
function layerAlert(layer, util, form, title = "修改个人信息", url = 'mine_info_modify.php', data = {
    real_name: '',
    password: '',
    confirmPassword: '',
}) {
    // 封装弹框
    layer.open({
        type: 1,
        area: '350px',
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
                                            <div class="layui-input-wrap">
                                                <div class="layui-input-prefix">
                                                    <i class="layui-icon layui-icon-username"></i>
                                                </div>
                                                <input type="text" name="real_name"  placeholder="真实姓名" autocomplete="off" class="layui-input" lay-affix="clear" value="${data.real_name}">
                                            </div>
                                        </div>
                                    <div class="layui-form-item">
                                        <div class="layui-input-wrap">
                                            <div class="layui-input-prefix">
                                                <i class="layui-icon layui-icon-password"></i>
                                            </div>
                                            <input type="password" name="password" value="" lay-verify="" placeholder="密码" autocomplete="off" class="layui-input" id="reg-password" lay-affix="eye">
                                        </div>
                                    </div>
                                        <div class="layui-form-item">
                                            <div class="layui-input-wrap">
                                                <div class="layui-input-prefix">
                                                    <i class="layui-icon layui-icon-password"></i>
                                                </div>
                                                <input type="password" name="confirmPassword" value="" lay-verify="confirmPassword" placeholder="确认密码" autocomplete="off" class="layui-input" lay-affix="eye">
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
            // 对弹层中的表单进行初始化渲染
            form.render();
            form.verify({
                // 确认密码
                confirmPassword: function(value, item) {
                    var passwordValue = $('#reg-password').val();
                    if (value !== passwordValue) {
                        return '两次密码输入不一致';
                    }
                }
            });
            // 表单提交事件
            form.on('submit(submit_btn)', function(data) {
                var field = data.field; // 获取表单字段值
                // 此处可执行 Ajax 等操作
                // …
                if (title == '新增分类') {
                    delete field['id'];
                }
                $.ajax({
                    headers: {
                        Accept: "application/json; charset=utf-8"
                    },
                    url,
                    method: 'post',
                    data: field,
                    success: (res) => {
                        let data = JSON.parse(res);
                        layer.alert(data.msg, {
                            title: "提示"
                        });
                        if (data.code === 0) {
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
}


layui.use('table', function() {
    var $ = layui.$;
    var layer = layui.layer;
    var util = layui.util;
    var form = layui.form;
    var table = layui.table;
    table.on('tool(test)', function(obj) {
        var tr = obj.data;
        let arr = Object.values(tr);
        var eventName = obj.event;
        if (eventName == 'edit') {
            //修改
            layerAlert(layer, util, form, "修改个人信息", 'mine_info_modify.php', tr)
        }
    });
});
</script>