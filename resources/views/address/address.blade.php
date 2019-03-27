<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>地址管理</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="{{url('css/comm.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{url('css/address.css')}}">
    <link rel="stylesheet" href="{{url('css/sm.css')}}">
</head>
<body>

<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">地址管理</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="{{url('address/witeaddr')}}" class="m-index-icon">添加</a>
</div>
<input type="hidden" id="_token" value="{{csrf_token()}}">
<div class="addr-wrapp">
    @foreach($data as $v)
        <div class="addr-list">
            <ul>
                <li class="clearfix">
                    <span class="fl">{{$v->address_name}}</span>
                    <span class="fr">{{$v->address_tel}}</span>
                </li>
                <li>
                    <p>{{$v->address_desc}}</p>
                </li>
                <li class="a-set" address_id="{{$v->address_id}}">
                    @if($v->address_default==1)
                        <s class="z-set" style="margin-top: 6px;"></s>
                    @else
                        <s class="z-defalt" style="margin-top: 6px;"></s>
                    @endif
                    <span class="status">设为默认</span>
                    <div class="fr">
                        <a href="{{url('address/addedit')}}/{{$v->address_id}}"><span class="edit">编辑</span></a>
                        <span class="remove">删除</span>
                    </div>
                </li>
            </ul>
        </div>
    @endforeach
</div>


<script src="{{url('js/zepto.js')}}" charset="utf-8"></script>
<script src="{{url('js/sm.js')}}"></script>
<script src="{{url('js/sm-extend.js')}}"></script>
<script src="{{url('js/jquery-1.8.3.min.js')}}"></script>
<script src="{{url('layui/layui.js')}}"></script>
<script>
    $(".footer").attr('style','display:none');
    layui.use('layer',function () {
        var layer=layui.layer;
        $(document).on('click','.status',function () {
            var _this=$(this);
            var address_id=_this.parent('li').attr('address_id');
            var _token=$("#_token").val();
            //console.log(_token);
            $.post(
                "{{url('address/addstatus')}}",
                {_token:_token,address_id:address_id},
                function (res) {
                    if(res==1){
                        layer.msg("设置成功");
                        _this.prev('s').removeClass('z-defalt').addClass('z-set');
                        _this.parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                    }else{
                        layer.msg("设置失败");
                    }
                }
            )
        })
        //删除地址
        $(document).on('click','span.remove', function () {
            var _this=$(this);
            var address_id=$(this).parents('li').attr('address_id');
            var _token=$("#_token").val();
            layer.confirm('确认删除么', {icon: 3, title:'提示'}, function(index){
                //do something
                $.post(
                    "{{url('address/adddel')}}",
                    {address_id:address_id,_token:_token},
                    function (res) {
                        if(res.code==1){
                            _this.parent('div').parents('.addr-list').remove();
                        }
                        layer.msg(res.font)
                    },'json'
                )
                layer.close(index);
            });
        });

    })

    var $$=jQuery.noConflict();
    $$(document).ready(function(){
        // jquery相关代码
        $$('.addr-list .a-set s').toggle(
            function(){
                if($$(this).hasClass('z-set')){

                }else{
                    $$(this).removeClass('z-defalt').addClass('z-set');
                    $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                }
            },
            function(){
                if($$(this).hasClass('z-defalt')){
                    $$(this).removeClass('z-defalt').addClass('z-set');
                    $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                }

            }
        )

    });

</script>



</body>
</html>
