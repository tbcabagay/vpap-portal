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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members');
            $table->string('type', 64);
            $table->mediumText('address')->nullable();
            $table->string('subdivision')->nullable();
            $table->string('barangay')->nullable();
            $table->foreignId('municipality_id')->nullable()->constrained('municipalities');
            $table->foreignId('province_id')->nullable()->constrained('provinces');
            $table->foreignId('region_id')->nullable()->constrained('regions');
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->string('zip_code', 64)->nullable();
            $table->string('phone_number', 64)->nullable();
            $table->string('mobile_number', 64)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
