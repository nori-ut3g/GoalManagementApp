<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            \Illuminate\Support\Facades\DB::statement('SET SESSION sql_require_primary_key=0');
            $table->uuid('id')->primary();
            $table->bigInteger('order')->default(0);
            $table->uuid('objective_id');
            $table->integer('status')->default(0);
            $table->string('title', 30)->nullable();
            $table->string('note', 200)->nullable();
            $table->date('start_date')->nullable()->default(NULL);;
            $table->date('finish_date')->nullable()->default(NULL);;
            $table->timestamps();

            $table->foreign('objective_id')->references('id')->on('objectives');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
