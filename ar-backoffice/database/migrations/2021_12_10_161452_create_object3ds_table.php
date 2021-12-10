<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObject3dsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object3ds', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable(false);
            $table->text('object_url')->nullable(false);
            $table->text('preview_url')->nullable(true);
            $table->bigInteger('download')->nullable(true)->default(0);
            $table->foreignId('user_id')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
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
        Schema::dropIfExists('object3ds');
    }
}
