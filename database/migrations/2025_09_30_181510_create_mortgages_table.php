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
        Schema::create('mortgages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->integer('price');
            $table->integer('down_amount')->default(null);
            $table->integer('apr_percent');
            $table->integer('years');
            $table->integer('annual_property_tax')->default(null);
            $table->string('annual_home_insurance')->default(null);
            $table->string('pmi_percent')->default(null);
            $table->string('hoa_monthly')->default(null);
            $table->date('start_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mortgages');
    }
};
