<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>填写收货地址</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{url('css/writeaddr.css')}}">
    <link rel="stylesheet" href="{{url('layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{url('dist/css/LArea.css')}}">
</head>
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">填写收货地址</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="javascript:;"  id="submits" class="m-index-icon">保存</a>
</div>
<div class=""></div>
<!-- <form class="layui-form" action="">
  <input type="checkbox" name="xxx" lay-skin="switch">

</form> -->
<form class="layui-form" action="">
    <div class="addrcon">
        <ul>
            <li>
                <font style="font-size: 18px">收货人</font><em></em>
                <input type="text" id="address_name" placeholder="请填写真实姓名" style="height:30px;font-size: 18px">
            </li>
            <li>
                <font style="font-size: 18px">手机号码</font><em></em>
                <input type="number" id="address_tel" placeholder="请输入手机号" style="height:30px;font-size: 18px">
            </li>
            <li>
                <font style="font-size: 18px">邮编</font><em></em>
                <input type="number" id="address_mail" placeholder="请输入邮编" style="height:30px;font-size: 18px">
            </li>
            <li class="addr-detail">
                <font style="font-size: 18px">详细地址</font><em></em>
                <input type="text" placeholder="20个字以内" id="address_desc" style="height:30px;font-size: 18px">
            </li>
        </ul>
        <div class="setnormal">
            <span><font style="font-size: 18px">设为默认地址</font></span>
            <input type="checkbox" id="address_default" lay-skin="switch">
        </div>
    </div>
    <input type="hidden" id="_token" value="{{csrf_token()}}">
</form>

<!-- SUI mobile -->
<script src="{{url('dist/js/LArea.js')}}"></script>
<script src="{{url('dist/js/LAreaData1.js')}}"></script>
<script src="{{url('dist/js/LAreaData2.js')}}"></script>
<script src="{{url('js/jquery-1.11.2.min.js')}}"></script>
<script src="{{url('layui/layui.js')}}"></script>

<script>
    $(function(){
        $(".footer").attr('style','display:none');
        layui.use(['form','layer'], function(){
            var form = layui.form();
            var layer = layui.layer;
            $("#submits").click(function(){
                var obj={};
                obj._token=$("#_token").val();
                obj.address_name=$("#address_name").val();
                obj.address_tel=$("#address_tel").val();
                obj.address_desc=$("#address_desc").val();
                obj.address_mail=$("#address_mail").val();
                var address_default=$("#address_default").prop('checked');
                if(address_default==true){
                    obj.address_default=1;
                }else{
                    obj.address_default=2;
                }
                $.post(
                    "{{url('address/addressadd')}}",
                    obj,
                    function(res){
                        if(res.code==1){
                            layer.msg(res.font,{icon:res.code,time:2000},function () {
                                location.href="{{url('address/address')}}";
                            });
                        }
                        layer.msg(res.font,{icon:res.code});
                    },'json'
                )
            })
            {{--//域的内容改变--}}
            {{--form.on('select', function(data){--}}
            {{--var id=data.value; //得到被选中的值--}}
            {{--var _this=$(this);--}}
            {{--var _token=$("#_token").val();--}}
            {{--var _option="<option value=''>--请选择--</option>";--}}
            {{--_this.nextAll('select').html(_option);--}}
            {{--$.post(--}}
            {{--"{{url('addressajax')}}",--}}
            {{--{id:id,_token:_token},--}}
            {{--function(res){--}}
            {{--if(res.code==1){--}}
            {{--for(var i in res['areaInfo']){--}}
            {{--_option+="<option value="+res['areaInfo'][i]['id']+">"+res['areaInfo'][i]['name']+"</option>"--}}
            {{--}--}}
            {{--console.log(_option);--}}
            {{--_this.next('div').html(_option);--}}
            {{--_this.nextAll('select');--}}
            {{--}else{--}}
            {{--layer.msg(res.font,{icon:res.code});--}}
            {{--}--}}
            {{--},'json'--}}
            {{--)--}}
            {{--});--}}
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
