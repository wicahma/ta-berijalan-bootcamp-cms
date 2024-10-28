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
        Schema::create('tbl_techstack_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('techstack_id');
            $table->foreignId('resource_id');
            $table->integer('level');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at')->nullable();
            $table->foreign('resource_id')->references('id')->on('mst_resources')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('techstack_id')->references('id')->on('mst_techstacks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_techstack_resources');
    }
};
