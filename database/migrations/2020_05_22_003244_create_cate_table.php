<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cate')) { 
            Schema::create('cate', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('cate_id');
                $table->string('cate_name');
                $table->integer('parent_id');
                $table->tinyInteger('is_show')->default(1);
                $table->tinyInteger('is_nav_show')->default(1);
                $table->string('cate_desc')->nullable($value=true);
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
        Schema::dropIfExists('cate');
    }
}
