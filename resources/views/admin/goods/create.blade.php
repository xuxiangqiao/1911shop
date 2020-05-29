<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"> 
    <title></title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{csrf_token() }}">
</head>
<body>
    <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">微商城</a>
    </div>
    <div>
        <ul class="nav navbar-nav">
            <li ><a href="{{url('/brand')}}">商品品牌</a></li>
            <li><a href="{{url('/cate')}}">商品分类</a></li>
            <li class="active"><a href="{{url('/goods')}}">商品管理</a></li>   
            <li><a href="{{url('/admin')}}">管理员管理</a></li>
        </ul>
    </div>
    </div>
</nav>  
<h2 align="center">商品添加<a style="float:right;" href="{{url('/goods')}}" class="btn btn-success">列表</a></h2><hr>
<!-- @if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
 @endforeach
 </ul> 
</div>
@endif -->
<form class="form-horizontal" role="form" action="{{url('/goods/store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="goods_name" id="firstname" 
                   placeholder="请输入商品名称">
            <span style="color: red">{{$errors->first('goods_name')}}</span>


        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品货号</label>
        <div class="col-sm-10">
            <input type="text"  class="form-control" name="goods_sn" id="lastname" 
                   placeholder="请输入商品货号">
            <span style="color: red">{{$errors->first('goods_sn')}}</span>
                   
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品分类</label>
        <div class="col-sm-3">
            <select name="cate_id" class="form-control">
                <option value=" ">请选择分类</option>
                @foreach($cate as $v)
                <option value="{{$v->cate_id}}">{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
                @endforeach
            </select>
            <span style="color: red">{{$errors->first('cate_id')}}</span>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品品牌</label>
        <div class="col-sm-3">
            <select name="brand_id" class="form-control">
                <option value=" ">请选择品牌</option>
                @foreach($brand as $v)
                <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                @endforeach
            </select>
            <span style="color: red">{{$errors->first('brand_id')}}</span>
        </div>
    </div>
        <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品主图</label>
        <div class="col-sm-4">
            <input type="file" class="form-control" name="goods_img" id="lastname" 
                   >
            <span style="color: red">{{$errors->first('goods_img')}}</span>

        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品相册</label>
        <div class="col-sm-4">
            <input type="file" multiple="multiple" class="form-control" name="goods_imgs[]" id="lastname" 
                   >
            <span style="color: red">{{$errors->first('goods_imgs')}}</span>

        </div>
    </div>
    
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品价格</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="goods_price" id="lastname" 
                   placeholder="请输入商品价格">
            <span style="color: red">{{$errors->first('goods_price')}}</span>

        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品库存</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="goods_number" id="lastname" 
                   placeholder="请输入商品库存">
            <span style="color: red">{{$errors->first('goods_number')}}</span>

        </div>
    </div>
    <!-- <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品积分</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="goods_score" id="lastname" 
                   placeholder="请输入商品库存">
            <span style="color: red">{{$errors->first('goods_score')}}</span>
                   
        </div>
    </div> -->
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否上下架</label>
        <div class="col-sm-10">
            <input type="radio"  name="is_on_sale" checked id="lastname" value="1">是
            <input type="radio"  name="is_on_sale" id="lastname" value="2">否
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">首页幻灯推荐位</label>
        <div class="col-sm-10">
            <input type="radio"  name="is_slice"  id="lastname" value="1">是
            <input type="radio"  name="is_slice" checked id="lastname" value="2">否
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否新品</label>
        <div class="col-sm-10">
            <input type="radio"  name="is_new" checked id="lastname" value="1">是
            <input type="radio"  name="is_new" id="lastname" value="2">否
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否精品</label>
        <div class="col-sm-10">
            <input type="radio"  name="is_best" checked id="lastname" value="1">是
            <input type="radio"  name="is_best" id="lastname" value="2">否
        </div>
    </div>
    <!-- <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否首页幻灯片推荐</label>
        <div class="col-sm-10">
            <input type="radio"  name="is_slide"  id="lastname" value="1">是
            <input type="radio"  name="is_slide" id="lastname" checked value="2">否
        </div>
    </div> -->
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品详情</label>
        <div class="col-sm-10">
            <textarea type="text" class="form-control" name="content" id="lastname" 
                   placeholder="请输入商品详情"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-default">提交</button>
        </div>
    </div>
</form>
<script>
//商品名称的失去焦点事件   
$('input[name="goods_name"]').blur(function(){
    $(this).next().empty();
    var goods_name = $(this).val();
    var reg =/^[\u4e00-\u9fa5\w]{2,50}$/ ;
    //验证规则
    if(!reg.test(goods_name)){
        $(this).next().text('商品名称可以包含中文、数字、字母、下划线且唯一，长度范围为2-50位');
        return;
    }
    //验证唯一性
    $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
    $.post('/goods/checkName',{goods_name:goods_name},function(res){
        if(res>0){
            $('input[name="goods_name"]').next().text('商品名称已存在');
        }
    })
});

//商品货号失去焦点
$('input[name="goods_sn"]').blur(function(){
    $(this).next().empty();
    var goods_sn = $(this).val();
    if(!goods_sn){
        $(this).next().text('商品货号不能为空');
        return;
    }
}); 

$('button').click(function(){
    var goods_name = $('input[name="goods_name"]').val();
    var reg =/^[\u4e00-\u9fa5\w]{2,50}$/ ;
    //验证规则
    if(!reg.test(goods_name)){
        $('input[name="goods_name"]').next().text('商品名称可以包含中文、数字、字母、下划线且唯一，长度范围为2-50位');
        return;
    }
    var flag = true;
    $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
    $.ajax({
       type: "POST",
       url: "/goods/checkName",
       data: {goods_name:goods_name},
       async:false,
       success: function(msg){
         if(msg>0){
            $('input[name="goods_name"]').next().text('商品名称已存在');
            flag = false;
         }
       }
    });

    if(!flag) return;

    var goods_sn = $('input[name="goods_sn"]').val();
    if(!goods_sn){
        $('input[name="goods_sn"]').next().text('商品货号不能为空');
        return;
    }
    $('form').submit();
});

</script>
</body>
</html>