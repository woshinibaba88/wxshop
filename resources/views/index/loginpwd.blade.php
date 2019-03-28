<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>修改登陆密码</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('css/login.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('css/findpwd.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{url('layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{url('css/modipwd.css')}}">
    <script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
</head>
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">修改登录密码</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>



<div class="wrapper">
    <form class="layui-form" action="">
        <div class="registerCon regwrapp">
            <div class="account">
                <em>账户名：</em> <i>{{$tel}}</i>
            </div>
            <input type="hidden" id="_token" value="{{csrf_token()}}">
            <div><em>当前密码</em><input id="oldpwd" type="password"placeholder="请输入旧密码"></div>
            <div><em>新密码</em><input type="password" id="newpwd" placeholder="请输入6-16位数字、字母组成的新密码"></div>
            <div><em>确认新密码</em><input type="password" id="newpwd1" placeholder="确认新密码"></div>
            <div class="save"><span>保存</span></div>
        </div>
    </form>
</div>


<script src="{{url('layui/layui.js')}}"></script>
<script>
    //Demo
    $(function(){
    layui.use(['form','layer'], function(){
        var form = layui.form();
        var layer=layui.layer;
        $(document).on("click",".save",function(){
            var _token=$("#_token").val();
            var oldpwd=$("#oldpwd").val();
            var newpwd=$("#newpwd").val();
            var newpwd1=$("#newpwd1").val();
            if(oldpwd==''){
                layer.msg("请输入原密码",{icon:2});
                return false;
            }
            if(!/^[a-zA-Z]{6,16}$/.test(oldpwd)){
                layer.msg("请输入6-16位字母组成的密码",{icon:2});
                return false;
            }
            if(newpwd==''){
                layer.msg("请输入新密码",{icon:2});
                return false;
            }
            if(!/^[a-zA-Z]{6,16}$/.test(newpwd)){
                layer.msg("请输入6-16位字母组成的密码",{icon:2});
                return false;
            }
            if(newpwd1==''){
                layer.msg("请再次输入新密码",{icon:2});
                return false;
            }
            if(!/^[a-zA-Z]{6,16}$/.test(newpwd1)){
                layer.msg("请输入6-16位字母组成的密码",{icon:2});
                return false;
            }
            if(newpwd!=newpwd1){
                later.msg("两次输入的密码不一致",{icon:2});
                return false;
            }
            $.post(
                "{{url('index/loginpwddo')}}",
                {_token:_token,oldpwd:oldpwd,newpwd:newpwd},
                function(res){
                    if(res.code==1){
                        layer.msg(res.font,{icon:res.code},function(){location.href="{{url('user/user')}}"})
                    }else{
                        layer.msg(res.font,{icon:res.code})
                    }
                },'json'
            )
        });
        //监听提交
        form.on('submit(formDemo)', function(data){
            layer.msg(JSON.stringify(data.field));
            return false;
        });
    });
    })
</script>

</body>
</html>
