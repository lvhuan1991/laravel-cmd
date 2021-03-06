<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collects', function (Blueprint $table) {
            $table->engine = 'InnoDB';//设置引擎
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->default(0)->comment('用户 id');
            $table->unsignedInteger('collect_id')->index()->default(0)->comment('文章 id/收藏 id');
            $table->string('collect_type')->index()->default('')->comment('收藏类型');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collects');
    }
}
