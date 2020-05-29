<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    public function index(){
    	/*********memcache****/
    	//$slice = Cache::get('slice');
    	//辅助函数
    	//$slice = cache('slice');
    	/*********redis****/
    	$slice = Redis::get('slice');
    	//dump($slice);
    	if(!$slice){
    		//echo "DB==";
	    	//首页幻灯片
	    	$slice = Goods::getSliceData();

	    	/*********memcache****/
	    	//Cache::put('slice',$slice,60*60);
	    	//辅助函数
	    	//cache(['slice'=>$slice],60);
	    	/*********redis****/
	    	$slice = serialize($slice);
	    	Redis::setex('slice',60,$slice);
		}
		$slice = unserialize($slice);
    	//dd($slice);
    	//获取顶级分类
    	$category = Category::getTopData();
    	//dd($category);
    	return view('index.index',compact('slice','category'));
    }
}
