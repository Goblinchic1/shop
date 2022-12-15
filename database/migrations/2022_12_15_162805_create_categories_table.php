<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('title');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // TODO Stabs
        if (app()->isLocal()) {
            Schema::dropIfExists('categories');
        }
    }
};
