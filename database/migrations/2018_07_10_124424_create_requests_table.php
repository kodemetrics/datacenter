<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rx',50);
            $table->integer('user_id');
            $table->string('name',50);
            $table->string('email',50);
            $table->string('whom',50);
            $table->string('dcenter',50);
            $table->string('reason');
            $table->string('comment');
            $table->string('awareness');
            $table->string('sname');
            $table->string('urgency',50);
            $table->string('status');
            $table->string('approvemgr');
            $table->softDeletes();
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
        Schema::dropIfExists('requests');
    }
}
