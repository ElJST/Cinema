<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->integer('seat_number');
            $table->boolean('is_reserved')->default(false);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('seats');
    }
};

