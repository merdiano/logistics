<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('account_id');
            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->boolean('winner')->default(0);
            $table->decimal('proposed_cost')->nullable();
            $table->unsignedSmallInteger('estimated_time')->nullable();
            $table->enum('estimated_time_unit',['minute','hour','day','week','month']);
            $table->string('comment')->nullable();
            $table->unsignedBigInteger('application_id');
            $table->foreign('application_id')->references('id')->on('applications');
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
        Schema::dropIfExists('bids');
    }
}
