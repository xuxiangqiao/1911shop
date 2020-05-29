<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('goods')) { 
            Schema::create('goods', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('goods_id');
                $table->string('goods_name')->unique();
                $table->string('goods_sn');
                $table->decimal('goods_price',10,2);
                $table->integer('cate_id')->unsigned();
                $table->foreign('cate_id')->references('cate_id')->on('cate');
                $table->integer('brand_id')->unsigned();
                $table->foreign('brand_id')->references('brand_id')->on('brand');
                $table->string('goods_img');
                $table->string('goods_imgs');
                $table->integer('goods_number');
                $table->tinyInteger('is_best')->default(1);
                $table->tinyInteger('is_new')->default(1);
                $table->tinyInteger('is_on_sale')->default(1);
                $table->text('content')->nullable($value=true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
