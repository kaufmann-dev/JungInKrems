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
        Schema::create('REQUESTS_ST', function (Blueprint $table) {
            $table->id('REQUEST_ID');
            $table->foreignId("ACCOUNT_ID")->constrained('ACCOUNT_has_FACILITIES_JT','ACCOUNT_ID')->onDelete('cascade');
            $table->foreignId("FACILITY_ID")->constrained('ACCOUNT_has_FACILITIES_JT','FACILITY_ID')->onDelete('cascade');
            $table->string('REQUEST_TYPE');
            $table->string('STATUS');
            $table->text('MESSAGE')->nullable();
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
        Schema::dropIfExists('REQUESTS_ST');
    }
};
