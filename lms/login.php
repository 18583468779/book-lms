<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登录-图书管理系统</title>
    <link href="./layui/css/layui.css" rel="stylesheet">
    <link href="./static/style.css" rel="stylesheet">
</head>

<body>
    <div class="center">
        <div class="layui-container ">
            <h1>登录-图书管理系统</h1>
            <form class="layui-form">
                <div class="demo-login-container">
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
                            <input type="password" name="password" value="" lay-verify="required" placeholder="密   码" lay-reqtext="请填写密码" autocomplete="off" class="layui-input" lay-affix="eye">
                        </div>
                    </div>
                    <!-- <div class="layui-form-item">
                        <div class="layui-row">
                            <div class="layui-col-xs7">
                                <div class="layui-input-wrap">
                                    <div class="layui-input-prefix">
                                        <i class="layui-icon layui-icon-vercode"></i>
                                    </div>
                                    <input type="text" name="captcha" value="" lay-verify="required" placeholder="验证码"
                                        lay-reqtext="请填写验证码" autocomplete="off" class="layui-input" lay-affix="clear">
                                </div>
                            </div>
                            <div class="layui-col-xs5">
                                <div style="margin-left: 10px;">
                                    <img src="https://www.oschina.net/action/user/captcha"
                                        onclick="this.src='https://www.oschina.net/action/user/captcha?t='+ new Date().getTime();">
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="layui-form-item">
                        <input type="checkbox" name="remember" lay-skin="primary" title="记住密码">
                        <a href="#forget" style="float: right; margin-top: 7px;">忘记密码？</a>
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="demo-login">登录</button>
                    </div>
                    <div class="layui-form-item demo-login-other">

                        <a href="add.php">无注册？注册帐号</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- 请勿在项目正式环境中引用该 layui.js 地址 -->
    <script src="./layui/layui.js"></script>
    <script src="./static/jquery.min.js"></script>
    <script>
        let cookie = getCookie('username');
        if (cookie) {
            layer.alert(`用户${cookie}已登录`, {
                title: "提示"
            });
            setTimeout(() => {
                window.location.href = '../lms/views/index.php';
            }, 1000);
        }
        layui.use(function() {
            var form = layui.form;
            var layer = layui.layer;
            // 提交事件
            form.on('submit(demo-login)', function(data) {
                var field = data.field; // 获取表单字段值
                // // 显示填写结果，仅作演示用
                // layer.alert(JSON.stringify(field), {
                //     title: '当前填写的字段值'
                // });
                $.ajax({
                    headers: {
                        Accept: "application/json; charset=utf-8"
                    },
                    url: 'login_check.php',
                    method: 'post',
                    data: field,
                    success: (res) => {
                        let data = JSON.parse(res);
                        layer.alert(data.msg, {
                            title: "提示"
                        });
                        if (data.flag === 0) {
                            setTimeout(() => {
                                window.location.href = '../lms/views/index.php';
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

        function getCookie(obj) {
            var arr_str = document.cookie.split("; ");
            for (let i = 0; i < arr_str.length; i++) {
                let temp = arr_str[i].split("=");
                if (temp[0] == obj) return unescape(temp[1]);
            }
        }
    </script>

</body>

</html>