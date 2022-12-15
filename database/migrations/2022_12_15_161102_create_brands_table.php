<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('title');
            $table->string('thumbnail')
                ->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('brands');
        }
    }
};
