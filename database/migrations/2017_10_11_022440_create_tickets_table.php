<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('message');
            $table->enum('situation', ['closed', 'invalid', 'wontfix', 'duplicate', 'open', 'resolved'])->default('open');
            $table->boolean('notification')->default(0);
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('priority_id');
            $table->unsignedInteger('category_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('priority_id')
                ->references('id')
                ->on('priorities')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
