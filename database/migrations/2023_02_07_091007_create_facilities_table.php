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
        Schema::create('FACILITIES_ST', function (Blueprint $table) {
            $table->foreignId("FACILITY_ID")->primary()->constrained('BOOKMARKS_BT','BOOKMARK_ID')->onDelete('cascade');
            $table->string('NAME')->unique();
            $table->text('DESCRIPTION');
            $table->string('WEBSITE_URL')->unique();
            $table->string('PHONE_NR')->unique();
            $table->string('EMAIL')->unique();
            $table->string('POSTAL_CODE');
            $table->string('CITY');
            $table->string('ADDRESS');
            $table->boolean('IS_CITY_VERIFIED')->default(false);
            $table->string('FACILITY_TYPE');
            $table->string('IMAGE_PATH');
            $table->rememberToken();
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
        Schema::dropIfExists('FACILITIES_ST');
    }
};
