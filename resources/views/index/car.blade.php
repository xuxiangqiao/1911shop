    @extends('index.layouts.shop')
     @section('title', '购物车列表')
     @section('content') 
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$buycount}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     @foreach($cart as $k=>$v)
     <div class="dingdanlist">
      <table>
        @if($k==0)
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 全选</a></td>
       </tr>
       @endif
       <tr>
        <td width="4%"><input type="checkbox" value="{{$v->cart_id}}" /></td>
        <td class="dingimg" width="15%"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>加入时间：{{date('Y-m-d H:i:s',$v->addtime)}}</time>
        </td>
        <td align="right"><input type="text" id="buy_{{$v->cart_id}}" class="spinnerExample" /></td>
       </tr>
       <tr>
        <th colspan="4"><strong class="orange">¥{{$v->goods_price}}</strong></th>
       </tr>
      </table>
     </div><!--dingdanlist/-->
     @endforeach
    <!--dingdanlist/-->
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange">¥<span class="total">0</span></strong></td>
       <td width="40%"><a href="pay.html" class="jiesuan">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->

  <script>
    $('input[type="checkbox"]').click(function(){
      //根据选中的复选框获取价格
      getPrice();
    });
    function getPrice(){
      //购物车记录ID
      var cart_id = new Array();
      //购买数量
      //var buy_number = new Array();
      $('input[type="checkbox"]:checked').each(function(i,k){
           cart_id.push($(this).val());
          // buy_number.push($(this).parents('tr').find('>td:last').find('.spinnerExample').val());
      });  
      alert(cart_id);
      //alert(buy_number);
      //ajax 获取价格
      $.get('/getprice',{cart_id:cart_id},function(res){
        $('.total').text(res);
      })
    }

  </script>

   @endsection