<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('content_category_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->enum('type', ['content','news','page', 'e-book']);
            $table->string('name');
            $table->string('author')->nullable();
            $table->string('alias')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
            $table->text('url')->nullable();
            $table->mediumText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('active')->default(1)->unsigned();
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('customer');

            $table->foreign('content_category_id')
                ->references('id')
                ->on('content_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content');
    }
}
