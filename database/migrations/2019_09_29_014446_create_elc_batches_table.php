<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElcBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('elc_batches')){    
            Schema::create('elc_batches', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('elc_id')->unsigned()->nullable();
                $table->integer('pid')->unsigned()->nullable();
                $table->string('product_name')->nullable();
                $table->string('batch_desc')->nullable();
                $table->string('batch_name')->nullable();
                $table->date('batch_start')->nullable();
                $table->date('batch_end')->nullable();
                $table->time('batch_timing_start')->nullable();
                $table->time('batch_timing_end')->nullable();
                $table->date('batch_last_date_adm')->nullable();
                $table->string('status')->nullable();
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
        Schema::dropIfExists('elc_batches');
    }
}
