<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	public $table = 'news';
    protected $primaryKey = 'n_id';
    protected $guarded = [];

    public function author() {
		return $this->hasOne('App\Author'); 
	}

}
