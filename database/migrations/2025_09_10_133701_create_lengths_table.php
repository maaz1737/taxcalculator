<?php

use App\Models\User;
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
        Schema::create('lengths', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('category');
            $table->string('from_unit', 16);     // e.g., 'm'
            $table->string('to_unit', 16);       // e.g., 'in'
            $table->decimal('value', 18, 6);     // input value
            $table->decimal('result', 24, 12)->nullable();     // input value
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lengths');
    }
};
