<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('dreams', function (Blueprint $table) {
            $table->bigInteger('board_id')->unsigned();
            $table->bigInteger('username')->nullable();
            $table->text('text');
            $table->boolean('incognito')->default(false);
            $table->integer('top')->default(20);
            $table->integer('left')->default(20);
            $table->string('background')->default('#30336b');
            $table->string('color')->default('#ffffff');
            $table->timestamps();

            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dreams');
    }
};
