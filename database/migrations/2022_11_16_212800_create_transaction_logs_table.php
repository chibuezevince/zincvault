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
        Schema::create('transaction_logs', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('cred_deb')->nullable();
            $table->string('type')->nullable();
            $table->string('time');
            $table->string('currency');
            $table->string('reason')->nullable();
            $table->string('amount');
            $table->string('inter_details')->nullable();
            $table->string('local_details')->nullable();
            $table->string('transaction_id')->nullable();
            $table->boolean('status');
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
        Schema::dropIfExists('transaction_logs');
    }
};
