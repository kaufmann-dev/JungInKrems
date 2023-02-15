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
        Schema::create('ACCOUNTS_ST', function (Blueprint $table) {
            $table->id("ACCOUNT_ID");
            $table->string('NAME')->unique();
            $table->string('EMAIL')->unique();
            $table->string('PASSWORD');
            $table->boolean('IS_EMAIL_VERIFIED')->default(false);
            $table->string('ACCOUNT_TYPE');
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
        Schema::dropIfExists('ACCOUNTS_ST');
    }
};
