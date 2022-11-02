<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->uuid('uuid')->unique();
            $table->boolean('is_created_by_api')->default(false);
            $table->bigInteger('property_type_id');
            $table->string('county');
            $table->string('country');
            $table->string('town');
            $table->string('postcode')->nullable();
            $table->text('description')->nullable();
            $table->string('address');
            $table->string('image_full')->nullable();
            $table->string('image_thumbnail')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('num_bedrooms')->default(1);
            $table->integer('num_bathrooms')->default(1);
            $table->integer('price')->default(0);
            $table->string('for')->default('sale');
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
        Schema::dropIfExists('properties');
    }
};
