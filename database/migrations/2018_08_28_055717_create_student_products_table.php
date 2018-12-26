<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->unsigned();
            $table->integer('batch_id')->unsigned();
            $table->decimal('standard_fee', 12, 2)->default(0);
            $table->decimal('max_discount_amount', 12, 2)->default(0);
            $table->decimal('books_cost', 12, 2)->default(0);
            $table->decimal('student_discount', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->decimal('applicable_gst', 12, 2)->default(0);
            $table->decimal('net_due', 12, 2)->default(0);
            $table->decimal('amount_paid', 12, 2)->default(0);
            $table->decimal('balance_amount', 12, 2)->default(0);
            $table->date('last_fee_submission_date')->nullable();
            $table->boolean('is_fee_submitted')->default(0);
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
        Schema::dropIfExists('student_products');
    }
}
