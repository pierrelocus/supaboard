<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterWidgetActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('widget_actions', function (Blueprint $table) {
            $table->integer('x');
            $table->integer('y');
            $table->integer('width');
            $table->integer('height');
            $table->boolean('auto_position');
            $table->string('text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('widget_actions', function (Blueprint $table) {
            //
        });
    }
}
