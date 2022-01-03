<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('column_settings', function (Blueprint $table) {
            $table->id();
            $table->string('table_title');
            $table->string('column_title');
            $table->string('type');
            $table->integer('ckeditor')->default('0');
            $table->integer('required')->default('0');
            $table->integer('size')->default('0');
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
        Schema::dropIfExists('column_settings');
    }
}
