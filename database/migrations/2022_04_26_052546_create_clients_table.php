<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->integer('agent_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('follow_up_date');
            $table->string('inq');
            $table->string('web');
            $table->string('status');
            $table->date('start_date');
            $table->string('notice');
            $table->string('insurer');
            $table->string('cover');
            $table->string('respond');
            $table->string('remark');
            $table->string('contact');
            $table->string('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
