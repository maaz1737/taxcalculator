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
        Schema::create('rent_calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('monthly_income');
            $table->string('monthly_debts');
            $table->string('rule');
            $table->string('utilities_monthly');
            $table->string('insurance_monthly');
            $table->string('rent');
            $table->string('target_savings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_calculations');
    }
};
