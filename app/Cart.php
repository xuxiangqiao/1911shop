<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Cart extends Model
{
     /**
	 * 关联到模型的数据表
	 *
	 * @var string 
	 * */
	protected $table = 'cart';
	/**
	* The primary key associated with the table. *
	* @var string
	*/
	protected $primaryKey = 'cart_id';
	/**
	* 表明模型是否应该被打上时间戳
	*
	* @var bool */
	public $timestamps = false;
	/**
	 * 黑名单
	* The attributes that aren't mass assignable. *
	* @var array
	*/
	protected $guarded = [];

	public static function  getPrice($cart_id){
		
		$cart_id = implode(',',$cart_id);
		$total = DB::select("select sum(buy_number*goods_price) as total FROM cart where cart_id in($cart_id)");
		return $total[0]->total;
	}
}
