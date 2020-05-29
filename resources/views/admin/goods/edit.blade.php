<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"> 
    <title></title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
<form class="form-horizontal" role="form" action="{{url('/goods/update/'.$goods->goods_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="{{$goods->goods_name}}" name="goods_name" id="firstname" 
                   placeholder="请输入商品名称">
            <span style="color: red">{{$errors->first('goods_name')}}</span>


        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品货号</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="{{$goods->goods_sn}}" name="goods_sn" id="lastname" 
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
                <option value="{{$v->cate_id}}"  @if($v->cate_id==$goods->cate_id) selected @endif>{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
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
                <option value="{{$v->brand_id}}" @if($v->brand_id==$goods->brand_id) selected @endif>{{$v->brand_name}}</option>
                @endforeach
            </select>
            <span style="color: red">{{$errors->first('brand_id')}}</span>
        </div>
    </div>
        <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品主图</label>
        <div class="col-sm-4">
            <input type="file" class="form-control" name="goods_img" id="lastname"         >
            <span style="color: red">{{$errors->first('goods_img')}}</span>

        </div>
         @if($goods->goods_img)
                <img src="{{env('UPLOADS_URL')}}{{$goods->goods_img}}" width="50">
           @endif    
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品相册</label>
        <div class="col-sm-4">
            <input type="file" multiple="multiple" class="form-control" name="goods_imgs[]" id="lastname" 
                   >

            <span style="color: red">{{$errors->first('goods_imgs')}}</span>

        </div>
        @if($v->goods_imgs)
                @php $imgarr = explode('|',$v->goods_imgs);@endphp
                @foreach($imgarr as $img)
                <img src="{{env('UPLOADS_URL')}}{{$img}}" width=50>
                @endforeach
                @endif
    </div>
    
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品价格</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="{{$goods->goods_price}}" name="goods_price" id="lastname" 
                   placeholder="请输入商品价格">
            <span style="color: red">{{$errors->first('goods_price')}}</span>

        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品库存</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="{{$goods->goods_number}}" name="goods_number" id="lastname" 
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
            <input type="radio"  name="is_on_sale" @if($goods->is_on_sale==1) checked @endif  id="lastname" value="1">是
            <input type="radio"  name="is_on_sale" @if($goods->is_on_sale==2) checked @endif id="lastname" value="2">否
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否新品</label>
        <div class="col-sm-10">
            <input type="radio"  name="is_new" @if($goods->is_new==1) checked @endif id="lastname" value="1">是
            <input type="radio"  name="is_new" @if($goods->is_new==2) checked @endif id="lastname" value="2">否
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否精品</label>
        <div class="col-sm-10">
            <input type="radio"  name="is_best" @if($goods->is_best==1) checked @endif id="lastname" value="1">是
            <input type="radio"  name="is_best" @if($goods->is_best==2) checked @endif id="lastname" value="2">否
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
                   placeholder="请输入商品详情">{{$goods->content}}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">提交</button>
        </div>
    </div>
</form>

</body>
</html>