<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('calc_type', 32)->index(); // bmi, bmr, tdee, body-fat, ideal, macros
            $table->json('inputs');
            $table->json('outputs');
            $table->timestamps();

            $table->index(['user_id', 'calc_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calculations');
    }
};
