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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->foreignId('sponsor_id')->nullable()->constrained('sponsors')->nullOnDelete();
            $table->string('attendance_type_id', 64)->index()->nullable();
            $table->string('member_discount_type_id', 64)->index()->nullable();
            $table->string('member_type_id', 64)->index()->nullable();
            $table->string('payment_type_id', 64)->index()->nullable();
            $table->decimal('membership_fee', 8, 2)->default(0.00);
            $table->decimal('event_fee', 8, 2)->default(0.00);
            $table->decimal('discount_fee', 8, 2)->default(0.00);
            $table->unsignedSmallInteger('discount_percentage')->default(0);
            $table->decimal('total_fees', 10, 2)->default(0.00);
            $table->decimal('cpd_points', 5, 2)->default(0.00);
            $table->string('payment_status');
            $table->string('attendance_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
