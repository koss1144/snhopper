<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('help_id');
            $table->unsignedTinyInteger('property_type_id')->index();
            $table->string('county', 50)->index();
            $table->string('country', 100)->index();
            $table->string('town', 50)->index();
            $table->text('description');
            $table->string('address', 200)->index();
            $table->string('image_full');
            $table->string('image_thumbnail');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->unsignedTinyInteger('num_bedrooms')->index();
            $table->unsignedTinyInteger('num_bathrooms')->index();
            $table->unsignedInteger('price')->index();
            $table->enum('type', ['sale', 'rent'])->index();
            $table->dateTime('updated_at');
            $table->dateTime('p_updated_at');
            $table->string('p_title', 50)->index();
            $table->text('p_description');
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
}
