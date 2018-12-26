<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFranchiseInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('franchise_info')){
            Schema::create('franchise_info', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned()->comment = 'Franchise User';
                $table->boolean('is_existing_elc')->nullable();
                $table->integer('elc_running_years')->nullable()->commnet = 'In Yrs.';
                $table->boolean('is_premise_owned')->nullable();
                $table->decimal('premise_area', 12, 2)->nullable()->commnet = 'In Sq. Feet';
                $table->string('franchise_profile')->nullable();
                $table->integer('investment_budget')->nullable()->commnet = 'In Lakhs';
                $table->string('courses')->nullable();
                $table->integer('days_req')->nullable()->comment = 'Days Required for Franchise';
                $table->boolean('has_plan')->nullable();
                $table->longText('franchise_plan')->nullable();
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
        Schema::dropIfExists('franchise_info');
    }
}
