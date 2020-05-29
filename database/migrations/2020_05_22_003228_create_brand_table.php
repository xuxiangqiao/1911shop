<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('brand')) { 
            Schema::create('brand', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('brand_id');
                $table->string('brand_name')->unique();
                $table->string('brand_url');
                $table->string('brand_logo');
                $table->string('brand_desc')->nullable($value=true);
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
        Schema::dropIfExists('brand');
    }
}
