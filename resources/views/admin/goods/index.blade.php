<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>微商城后台 - 商品品牌</title>
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
			<li><a style="float:right">欢迎【{{session('admin')->admin_name}}】</a></li>
		</ul>
<a href="{{url('/logout')}}">退出</a>
	</div>
	</div>
</nav>	
<center>
<h1>商品列表
	<span style="float:right;"><a class="btn btn-default" href="{{url('/goods/create')}}">添加</a></span>
</h1>
</center>
<hr/>
<form action='' method=''>
<input type="text" name="name" value="{{$name}}" placeholder="请输入商品名称关键字">
<select name="cate_id">
	<option value=''>请选择商品分类</option>

	@foreach($cate as $v)
    <option value="{{$v->cate_id}}" @if($v->cate_id==$cate_id) selected="selected" @endif>{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
     @endforeach

</select>
<input type="text" name="startprice" value="{{$startprice}}" placeholder="请输入商品价格">——
<input type="text" name="endprice" value="{{$endprice}}" placeholder="请输入商品价格">
<button>搜索</button>
</form>
<table class="table">
	
	<thead>
		<tr>
			<th>商品ID</th>
			<th>商品名称</th>
			<th>商品货号</th>
			<th>所属分类</th>
			<th>所属品牌</th>
			<th>商品价格</th>
			<th>商品库存</th>
			<th>是否上下架</th>
			<th>是否新品</th>
			<th>是否精品</th>
			<th>商品相册</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($goods as $k=>$v)
		<tr @if($k%2==0) class="active" @else  class="success" @endif>
			<td>{{$v->goods_id}}</td>
			<td>
				@if($v->goods_img)
				<img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width=50>
				@endif
				{{$v->goods_name}}
			</td>
			<td>{{$v->goods_sn}}</td>
			<td>{{$v->cate_name}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->goods_price}}</td>
			<td>{{$v->goods_number}}</td>
			<td>{{$v->is_on_sale?'√':'×'}}</td>
			<td>{{$v->is_new?'√':'×'}}</td>
			<td>{{$v->is_best?'√':'×'}}</td>
			<td>
				@if($v->goods_imgs)
				@php $imgarr = explode('|',$v->goods_imgs);@endphp
				@foreach($imgarr as $img)
				<img src="{{env('UPLOADS_URL')}}{{$img}}" width=50>
				@endforeach
				@endif
			</td>
			<td>
				<a class="btn btn-primary" href="{{url('/goods/edit/'.$v->goods_id)}}">编辑</a>|
				<a class="btn btn-danger" id="{{$v->goods_id}}" href="javascript:void(0)">删除</a>
			</td>
		</tr>
		@endforeach
		
		<tr><td colspan=12>{{$goods->appends(['name'=>$name,'cate_id'=>$cate_id])->links()}}</td></tr>
	</tbody>
</table>
<script>	
	//ajax 删除
	$('.btn-danger').click(function(res){
		var id = $(this).attr('id');
		var obj = $(this);
		if(confirm('您确定要删除此条记录吗？')){
			//$.get
			$.get('/goods/destroy/'+id,function(res){
				if(res.code=='00000'){
			         //location.href="/goods";
			        obj.parents('tr').hide();
				}
			},'json');
		}
	});

	// //无刷新分页
	// $(document).on('click','.page-item a',function(){
	// //$('.page-item a').click(function(){
	// 	var url = $(this).attr('href');
		
	// 	$.get(url,function(res){
	// 		$('tbody').html(res);
	// 	});
	// 	return false;
	// });
	// 
	
</script>
</body>
</html>