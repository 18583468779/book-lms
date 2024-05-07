<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注册-图书管理系统</title>
    <link href="./layui/css/layui.css" rel="stylesheet">
    <link href="./static/style.css" rel="stylesheet">
</head>

<body>
    <div class="center">
        <div class="layui-container ">
            <h1>注册-图书管理系统</h1>
            <form class="layui-form">
                <div class="demo-reg-container">
                    <!-- <div class="layui-form-item">
                        <div class="layui-row">
                            <div class="layui-col-xs7">
                                <div class="layui-input-wrap">
                                    <div class="layui-input-prefix">
                                        <i class="layui-icon layui-icon-cellphone"></i>
                                    </div>
                                    <input type="email" name="email" value="" lay-verify="required|email" placeholder="电子邮箱" lay-reqtext="请填写邮箱" autocomplete="off" class="layui-input" id="reg-cellphone">
                                </div>
                            </div>
                            <div class="layui-col-xs5">
                                <div style="margin-left: 11px;">
                                    <button type="button" class="layui-btn layui-btn-fluid layui-btn-primary" lay-on="reg-get-vercode">获取验证码</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-wrap">
                            <div class="layui-input-prefix">
                                <i class="layui-icon layui-icon-vercode"></i>
                            </div>
                            <input type="text" name="vercode" value="" lay-verify="required" placeholder="验证码" lay-reqtext="请填写验证码" autocomplete="off" class="layui-input">
                        </div>
                    </div> -->
                    <div class="layui-form-item">
                        <div class="layui-input-wrap">
                            <div class="layui-input-prefix">
                                <i class="layui-icon layui-icon-username"></i>
                            </div>
                            <input type="text" name="username" value="" lay-verify="required" placeholder="用户名" lay-reqtext="请填写用户名" autocomplete="off" class="layui-input" lay-affix="clear">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-wrap">
                            <div class="layui-input-prefix">
                                <i class="layui-icon layui-icon-password"></i>
                            </div>
                            <input type="password" name="password" value="" lay-verify="required" placeholder="密码" autocomplete="off" class="layui-input" id="reg-password" lay-affix="eye">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-wrap">
                            <div class="layui-input-prefix">
                                <i class="layui-icon layui-icon-password"></i>
                            </div>
                            <input type="password" name="confirmPassword" value="" lay-verify="required|confirmPassword" placeholder="确认密码" autocomplete="off" class="layui-input" lay-affix="eye">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-wrap">
                            <div class="layui-input-prefix">
                                <i class="layui-icon layui-icon-username"></i>
                            </div>
                            <input type="text" name="real_name" value="" placeholder="昵称" autocomplete="off" class="layui-input" lay-affix="clear">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <input type="checkbox" name="agreement" lay-verify="required" lay-skin="primary" title="同意">
                        <a href="#terms" target="_blank" style="position: relative; top: 6px; left: -15px;">
                            <ins>用户协议</ins>
                        </a>
                        <a href="./login.php">登录已有帐号</a>
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="demo-reg">注册</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

</body>
<script src="./layui/layui.js"></script>
<script src="./static/jquery.min.js"></script>

<script>
    layui.use(function() {
        var form = layui.form;
        var layer = layui.layer;

        form.verify({
            // 确认密码
            confirmPassword: function(value, item) {
                var passwordValue = $('#reg-password').val();
                if (value !== passwordValue) {
                    return '两次密码输入不一致';
                }
            }
        });

        // 提交事件
        form.on('submit(demo-reg)', function(data) {
            var field = data.field; // 获取表单字段值
            // // 显示填写结果，仅作演示用
            // layer.alert(JSON.stringify(field), {
            //     title: '当前填写的字段值'
            // });
            $.ajax({
                headers: {
                    Accept: "application/json; charset=utf-8"
                },
                url: 'add_check.php',
                method: 'post',
                data: field,
                success: (res) => {
                    let data = JSON.parse(res);
                    layer.alert(data.msg, {
                        title: "提示"
                    });
                    if (data.flag === 0) {
                        setTimeout(() => {
                            window.location.href = './login.php';
                        }, 1000);
                    }
                },
                error: (e) => {
                    console.log('e', e)
                }
            })
            return false; // 阻止默认 form 跳转
        });
    });
</script>

</html>