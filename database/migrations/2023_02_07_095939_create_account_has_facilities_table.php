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
        Schema::create('ACCOUNT_has_FACILITIES_JT', function (Blueprint $table) {
            $table->primary(['FACILITY_ID', 'ACCOUNT_ID']);
            $table->foreignId("FACILITY_ID")->constrained('FACILITIES_ST','FACILITY_ID')->onDelete('cascade');
            $table->foreignId("ACCOUNT_ID")->constrained('ACCOUNTS_ST','ACCOUNT_ID')->onDelete('cascade');
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
        Schema::dropIfExists('ACCOUNT_has_FACILITIES_JT');
    }
};
