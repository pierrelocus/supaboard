<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WidgetActionsTableAddDefaults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('widget_actions', function (Blueprint $table) {
            $table->integer('x')->nullable()->change();
            $table->integer('y')->nullable()->change();
            $table->integer('width')->nullable()->change();
            $table->integer('height')->nullable()->change();
            $table->boolean('auto_position')->nullable()->change();
            $table->string('text')->nullable()->change();
            $table->string('data')->nullable()->change();
            $table->string('type')->nullable()->change();
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
