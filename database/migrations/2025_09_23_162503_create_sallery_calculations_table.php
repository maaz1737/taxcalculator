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
        Schema::create('sallery_calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('annual_amount');
            $table->string('after_tax');
            $table->string('hourly');
            $table->string('weekly');
            $table->string('biweekly')->nullable();
            $table->string('monthly');
            $table->string('semimonthly');
            $table->string('medicare_levy');
            $table->string('tax');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sallery_calculations');
    }
};
