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
        Schema::create('network_reports', function (Blueprint $table) {
            $table->id();
            $table->string('State');
            $table->integer('Hub');
            $table->integer('Spoke')->nullable();
            $table->integer('Doctors')->nullable();
            $table->integer('CHO')->nullable();
            $table->integer('OPD_V1')->nullable();
            $table->integer('OPD_V2')->nullable();
            $table->integer('Total_OPD')->nullable();
            $table->integer('HWC_V1')->nullable();
            $table->integer('HWC_V2')->nullable();
            $table->integer('Total_HWC')->nullable();
            $table->integer('Total_Consultation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('network_reports');
    }
};
