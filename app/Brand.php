<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /**
	 * 关联到模型的数据表
	 *
	 * @var string 
	 * */
	protected $table = 'brand';
	/**
	* The primary key associated with the table. *
	* @var string
	*/
	protected $primaryKey = 'brand_id';
	/**
	* 表明模型是否应该被打上时间戳
	*
	* @var bool */
	public $timestamps = false;
	/**
	 * 白名单
	* 可以被批量赋值的属性.
	*
	* @var array */
	//protected $fillable = ['brand_name','brand_url','brand_logo','brand_desc'];
	/**
	 * 黑名单
	* The attributes that aren't mass assignable. *
	* @var array
	*/
	protected $guarded = [];

	public static function getBrandIndex($pageSzie,$where){
 
		return self::where($where)->orderBy('brand_id','desc')->paginate($pageSzie);
	}
}
