<?php
include('header.php');
?>
<div class="layui-body">
    <!-- 分类管理-分类信息列表 -->
    <div style="padding: 15px;">
        <h2>图书管理</h2>
        <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title">
                <li class="layui-this">图书列表</li>
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
                    <button type="button" class="layui-btn" lay-on="test-page-custom">
                        <i class="layui-icon layui-icon-add-1"></i>
                        增加
                    </button>
                </div>
                <div style="margin-top:30px">
                    <table class="layui-table" lay-filter="test" lay-data="{url:'./book_get.php', page: true, limit: 6, limits:[6]}" id="ID-table-demo-theads-1">
                        <thead>
                            <tr>
                                <th lay-data="{checkbox:true}" rowspan="2"></th>
                                <th lay-data="{field:'book_name'}" rowspan="2">图书名称</th>
                                <th lay-data="{field:'book_assort'}" rowspan="2">图书类型</th>
                                <th lay-data="{field:'book_position'}" rowspan="2">存放位置</th>
                                <th lay-data="{field:'book_num'}" rowspan="2">图书数量</th>
                                <th lay-data="{fixed: 'right', width: 160, align: 'center', toolbar: '#templet-demo-theads-tool'}" rowspan="2">操作</th>
                            </tr>
                            <script type="text/html" id="templet-demo-theads-tool">
                                <div class="layui-clear-space">
                                    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                                    <a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>
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
    function layerAlert(layer, util, form, title = "新增图书", url = 'book_save.php', data = {
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
                                        <input type="text" name="book_name" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input" value="${data.book_name}">
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">图书类型*</label>
                                        <div class="layui-input-block">
                                            <select name="book_assort" lay-filter="" lay-verify="required" >
                                                <option value=""></option>
                                                <?php
                                                $row = $db->table('assort')->get();
                                                if ($row) :
                                                    foreach ($row as $key => $val) :
                                                ?>
                                                        <option value="<?php echo $val['assort_name']; ?>"  ><?php echo $val['assort_name']; ?></option>
                                                    <?php
                                                    endforeach;
                                                endif;
                                                    ?>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">图书位置*</label>
                                        <div class="layui-input-block">
                                            <select name="book_position" lay-filter="" lay-verify="required">
                                                <option value=""></option>
                                                <?php
                                                $row = $db->table('position')->get();
                                                if ($row) :
                                                    foreach ($row as $key => $val) :
                                                ?>
                                                        <option value="<?php echo $val['position_name']; ?>" ><?php echo $val['position_name']; ?></option>
                                                    <?php
                                                    endforeach;
                                                endif;
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <div class="layui-inline">
                                            <label class="layui-form-label">图书数量*</label>
                                            <div class="layui-input-inline" style="width: 100px;">
                                                <input type="number" name="book_num" placeholder="" autocomplete="off" class="layui-input" min="1" step="1" lay-affix="number" value="${data.book_num}">
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
                // 对弹层中的表单进行初始化渲染
                form.render();
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
    }

    layui.use(function() {
        var $ = layui.$;
        var layer = layui.layer;
        var util = layui.util;
        var form = layui.form;
        console.log('1111')
        // 事件
        util.on('lay-on', {
            'test-page-custom': function() {

                layerAlert(layer, util, form)
            }
        });
    });

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
            if (eventName == 'del') {
                //删除
                layer.confirm("您确认删除吗？", function(index) {


                    $.ajax({
                        headers: {
                            Accept: "application/json; charset=utf-8"
                        },
                        url: 'book_delete.php',
                        method: 'post',
                        data: {
                            id: tr.id
                        },
                        success: (res) => {
                            let data = JSON.parse(res);
                            layer.alert(data.msg, {
                                title: "提示"
                            });
                            if (data.code === 0) {
                                setTimeout(() => {
                                    obj.del();
                                    layer.close(index);
                                    window.location
                                        .reload();
                                }, 1000);
                            }
                        },
                        error: (e) => {
                            console.log('e', e)
                        }
                    })
                })
            } else if (eventName == 'edit') {
                //修改
                layerAlert(layer, util, form, "编辑分类", 'assort_save.php', tr)
            }
        });
    });
</script>