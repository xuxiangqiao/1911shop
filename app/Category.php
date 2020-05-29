<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
	 * 关联到模型的数据表
	 *
	 * @var string 
	 * */
	protected $table = 'category';
	/**
	* The primary key associated with the table. *
	* @var string
	*/
	protected $primaryKey = 'cate_id';
	/**
	* 表明模型是否应该被打上时间戳
	*
	* @var bool */
	public $timestamps = false;

	public static function getTopData(){
		return self::select('cate_id','cate_name')->where(['parent_id'=>0,'is_nav_show'=>1])->take(4)->get();
	}
}
