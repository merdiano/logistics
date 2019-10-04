<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('winning_bid_id')->nullable();
            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('account_id')->references('id')->on('accounts');
//            $table->foreign('winning_bid_id')->references('id')->on('bids');
            $table->boolean('approved')->default(0);
            $table->dateTime('bidding_ends_at')->nullable();
            $table->decimal('estimated_cost')->nullable();
            $table->unsignedSmallInteger('estimated_time')->nullable();
            $table->enum('estimated_time_unit',['minute','hour','day','week','month']);
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->unsignedInteger('pickup_location_id')->nullable();
            $table->string('pickup_address')->nullable();
            $table->string('destination_address')->nullable();
            $table->unsignedInteger('destination_location_id')->nullable();
            $table->foreign('pickup_location_id')->references('id')->on('locations');
            $table->foreign('destination_location_id')->references('id')->on('locations');
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
        Schema::dropIfExists('applications');
    }
}
