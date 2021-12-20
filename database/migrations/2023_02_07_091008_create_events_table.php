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
        Schema::create('EVENTS_ST', function (Blueprint $table) {
            //$table->unsignedBigInteger('EVENT_ID')->primary();
            //$table->unsignedBigInteger('ACCOUNT_ID');
            $table->foreignId("EVENT_ID")->primary()->constrained('BOOKMARKS_BT','BOOKMARK_ID')->onDelete('cascade');
            $table->foreignId("ACCOUNT_ID")->constrained('ACCOUNTS_ST','ACCOUNT_ID')->onDelete('cascade');
            $table->foreignId("FACILITY_ID")->nullable()->constrained('FACILITIES_ST','FACILITY_ID')->onDelete('cascade');
            $table->string('TITLE');
            $table->timestamp('STARTING_TIME');
            $table->timestamp('ENDING_TIME')->nullable();
            $table->string('WEBSITE_URL')->nullable();
            $table->string('PHONE_NR')->nullable();
            $table->string('EMAIL')->nullable();
            $table->string('POSTAL_CODE');
            $table->string('CITY');
            $table->string('ADDRESS');
            $table->string('IMAGE_PATH');
            $table->string('DESCRIPTION');
            $table->string('EVENT_TYPE');
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
        Schema::dropIfExists('EVENTS_ST');
    }
};
