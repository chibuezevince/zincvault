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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('account_number')->unique();
            $table->string('pound_balance')->nullable();
            $table->string('dollar_balance')->nullable();
            $table->string('euro_balance')->nullable();
            $table->string('account_type')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('gender')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('tac')->nullable();
            $table->string('tax')->nullable();
            $table->string('imf')->nullable();
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
        Schema::dropIfExists('user_details');
    }
};