<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>微商城后台 - 商品分类</title>
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
			<li class="active"><a href="{{url('/cate')}}">商品分类</a></li>
			<li><a href="{{url('/goods')}}">商品管理</a></li>	
			<li><a href="{{url('/admin')}}">管理员管理</a></li>
		</ul>
	</div>
	</div>
</nav>		
<center>
<h1>商品分类
	<span style="float:right;"><a class="btn btn-default" href="{{url('/cate')}}">列表</a></span>
</h1>
</center>
<hr/>

<!-- @if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
 @endforeach
</ul> </div>
@endif -->
<form class="form-horizontal" role="form" method="post" action="{{url('/cate/store')}}" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="cate_name" id="firstname" 
				   placeholder="请输入品牌名称">
			<b style="color:red">{{$errors->first('brand_name')}}</b>	   
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">父级分类</label>
		<div class="col-sm-10">
			<select class="form-control" name="parent_id" id="lastname" >
				  <option value='0'>请选择</option>
				  @foreach($cate as $v)
				  <option value='{{$v->cate_id}}'>{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
				  @endforeach
			</select>	  
			<b style="color:red">{{$errors->first('brand_url')}}</b>	   
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_show" value='1' id="lastname" checked >是
			<input type="radio"  name="is_show" value='2' id="lastname" >否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否导航显示</label>
		<div class="col-sm-10">
			<input type="radio" name="is_nav_show" value='1' id="lastname" >是
			<input type="radio"  name="is_nav_show" value='2' id="lastname" checked >否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" id="lastname" name="cate_desc" ></textarea>
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