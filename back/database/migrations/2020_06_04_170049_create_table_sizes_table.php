<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_sizes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('size')->nullable(false);
            $table->string('name1')->nullable(true);
            $table->string('age1')->nullable(true);
            $table->string('rf1')->nullable(true);
            $table->string('height1')->nullable(true);
            $table->string('chest1')->nullable(true);
            $table->string('waist1')->nullable(true);
            $table->string('name2')->nullable(true);
            $table->string('age2')->nullable(true);
            $table->string('rf2')->nullable(true);
            $table->string('height2')->nullable(true);
            $table->string('chest2')->nullable(true);
            $table->string('waist2')->nullable(true);
            $table->string('name3')->nullable(true);
            $table->string('age3')->nullable(true);
            $table->string('rf3')->nullable(true);
            $table->string('height3')->nullable(true);
            $table->string('chest3')->nullable(true);
            $table->string('waist3')->nullable(true);
            $table->string('name4')->nullable(true);
            $table->string('age4')->nullable(true);
            $table->string('rf4')->nullable(true);
            $table->string('height4')->nullable(true);
            $table->string('chest4')->nullable(true);
            $table->string('waist4')->nullable(true);
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
        Schema::dropIfExists('table_sizes');
    }
}
