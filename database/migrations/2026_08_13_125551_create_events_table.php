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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('type_id')->index();
            $table->string('invitation_type_id')->index();
            $table->tinyText('title')->index();
            $table->tinyText('location')->index();
            $table->date('start_date')->index();
            $table->date('end_date')->index();
            $table->boolean('discount_enabled')->default(false);
            $table->decimal('membership_fee', 8, 2);
            $table->decimal('total_cpd_points', 5, 2);
            $table->unsignedSmallInteger('maximum_participants');
            $table->string('evaluation_link', 1000)->nullable();
            $table->string('invitation_link', 1000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
