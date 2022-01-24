<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharedObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shared_objectives', function (Blueprint $table) {
            \Illuminate\Support\Facades\DB::statement('SET SESSION sql_require_primary_key=0');
            $table->uuid('id')->primary();
            $table->uuid('objective_id');
            $table->foreign('objective_id')->references('id')->on('objectives');
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
        Schema::dropIfExists('shared_objectives');
    }
}
