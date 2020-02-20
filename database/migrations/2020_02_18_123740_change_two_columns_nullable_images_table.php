<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTwoColumnsNullableImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->bigInteger('imageable_id')->unsigned()->nullable()->change();
            $table->string('imageable_type')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->bigInteger('imageable_id')->unsigned()->nullable(false)->change();
            $table->string('imageable_type')->nullable(false)->change();
        });
    }
}
