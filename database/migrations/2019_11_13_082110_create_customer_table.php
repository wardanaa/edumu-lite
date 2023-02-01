<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->string('email')->nullable();
            $table->string('reg_id')->nullable();
            $table->string('api_token')->unique()->nullable();
            $table->string('device_name')->nullable();
            $table->string('username');
            $table->string('password');
            $table->string('name');
            $table->string('no_reg')->nullable();
            $table->string('position')->nullable();
            $table->string('company')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->tinyInteger('active')->default(1)->unsigned();
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
        Schema::dropIfExists('customer');
    }
}
