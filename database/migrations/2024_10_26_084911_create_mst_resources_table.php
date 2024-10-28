<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mst_resources', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('npk', 10);
            $table->string('email', 100);
            $table->string('phone_number', 20);
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at')->nullable();
            $table->foreign('section_id')->references('id')->on('mst_sections')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('mst_roles')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('mst_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('mst_categories')->onUpdate('cascade')->onDelete('cascade');    
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_resources');
    }
};
