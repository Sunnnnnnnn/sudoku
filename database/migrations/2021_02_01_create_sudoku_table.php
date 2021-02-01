<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SudokuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sudoku', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->text('content')->comment('题目');//题目
            $table->text('answer')->comment('答案');//答案
            $table->string('key',10)->comment('标识');;//标识
            $table->string('level')->comment('级别'); //级别
            $table->string('date')->comment('日期');;//日期
            $table->unsignedInteger('created_at')->default(0)->comment('创建时间');
            $table->unsignedInteger('updated_at')->default(0)->comment('更新时间');
            $table->unsignedInteger('deleted_at')->default(0)->comment('删除时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('failed_jobs');
    }
}
