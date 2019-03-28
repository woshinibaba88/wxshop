<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>修改昵称</title>
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
    <strong id="m-title">修改昵称密码</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>



<div class="wrapper">
    <form class="layui-form" action="">
        <div class="registerCon regwrapp">
            <input type="hidden" id="_token" value="{{csrf_token()}}">
            <div><em>当前密码</em><input id="name" type="text"placeholder="请输入昵称"></div>
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
                var name=$("#name").val();
                if(name==''){
                    layer.msg("昵称不能为空",{icon:2});
                    return false;
                }
                $.post(
                    "{{url('index/updnamedo')}}",
                    {_token:_token,name:name},
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
