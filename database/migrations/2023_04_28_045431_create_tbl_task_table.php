<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_task', function (Blueprint $table) {
            $table->id('task_id');
            $table->integer('project_id');
            $table->integer('task_assign_to');
            $table->integer('task_assign_by');
            $table->date('task_due');
            $table->date('task_status');
            $table->timestamp('task_created_at')->useCurrent();
            $table->timestamp('task_updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_task');
    }
}
