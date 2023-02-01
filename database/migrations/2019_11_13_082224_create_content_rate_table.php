<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_rate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('content_id');
            $table->unsignedBigInteger('customer_id');
            $table->integer('rating')->default(0);
            $table->timestamps();

            $table->foreign('content_id')
                ->references('id')
                ->on('content')
                ->onDelete('cascade');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_rate');
    }
}
