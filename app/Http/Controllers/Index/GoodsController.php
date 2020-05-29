<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cart;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class GoodsController extends Controller
{
    public function index($goods_id){
        //Cache::flush();
        //当前页面的访问量
        // $visit = Cache::add('visit_'.$goods_id,1)?1:Cache::increment('visit_'.$goods_id);
        $visit =Redis::setnx('visit_'.$goods_id,1)?:Redis::incr('visit_'.$goods_id);

        //Cache::forget('goods_'.$goods_id);
       // $goods = Cache::get('goods_'.$goods_id);
        //辅助函数
        $goods = cache('goods_'.$goods_id);
        //dump($goods);
        if(!$goods){
            echo "DB==";
            $goods = Goods::find($goods_id);
           // Cache::put('goods_'.$goods_id,$goods,60);
           //辅助函数 
           cache(['goods_'.$goods_id=>$goods],60);
        }
    	
        //dd($goods);
    	return view('index.goods',['goods'=>$goods,'visit'=>$visit]);

    }

    /**
     * [addcar 加入购物车]
     *1: 判断是否登录  没登录：提示 跳转到登录  
     *2： 判断商品是否上架  下架：提示商品下架 
     *3： 判断库存 购买数量大于库存 提示购买数量大于库存  
     *4：判断是否加入过此商品  有此商品（update）：购买数量相加 加完后再次判断库存   没有：add 入库
     *
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function addcar(Request $request){
    	$goods_id = $request->goods_id;
    	$buy_number = $request->buy_number;
    	
    	//1: 判断是否登录  没登录：提示 跳转到登录  
    	$user = session('user');
    	if(!$user){
    		echo json_encode(['code'=>'00001','msg'=>'用户未登录']); die;
    	}

    	$goods = Goods::find($goods_id);
    	//2： 判断商品是否上架  下架：提示商品下架 
    	if($goods->is_on_sale!=1){
    		echo json_encode(['code'=>'00002','msg'=>'对不起，商品已下架']); die;
    	}
    	//3： 判断库存 购买数量大于库存 提示库存不足
    	if($buy_number>$goods->goods_number){
    		echo json_encode(['code'=>'00003','msg'=>'商品库存不足']); die;
    	}
    	//4：判断购物车内是否加入过此商品  有此商品（update）：购买数量相加 加完后再次判断库存   没有：add 入库
    	$where=['user_id'=>$user->member_id,'goods_id'=>$goods_id];
    	$cart = Cart::where($where)->first();
    	//dump($cart);
    	if(!$cart){
    		//没有：add 入库
    		$data = [
    			'user_id'=>$user->member_id,
    			'goods_id'=>$goods_id,
    			'goods_name'=>$goods->goods_name,
    			'goods_img'=>$goods->goods_img,
    			'buy_number'=>$buy_number,
    			'goods_price'=>$goods->goods_price,
    			'addtime'=>time()
    		];
    		$res = Cart::create($data);
    	}else{
    		//更新
    		$buy_number = $buy_number+$cart->buy_number;
    		
    		if($buy_number>=$goods->goods_number){
    			$buy_number = $goods->goods_number;
    		}
    		$res = Cart::where($where)->update(['buy_number'=>$buy_number]);
    	}
    	if($res!==false){
    		echo json_encode(['code'=>'00000','msg'=>'加入成功']); die;
    	}
    }


    public function getprice(){
        $cart_id = request()->cart_id;
        
        //根据商品ID 计算总价
        $total = Cart::getPrice($cart_id);

        return  $total;
    }


}
