<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRunParticipationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('run_participations', function (Blueprint $table) {
            $table->uuid('runner_id')->primary();
            $table->uuid('run_id')->nullable(false);

            $table->foreign('runner_id')->references('id')->on('runners');
            $table->foreign('run_id')->references('id')->on('runs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('run_participations');
    }
}
