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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('first_name', 64);
            $table->string('middle_name', 64)->nullable();
            $table->string('last_name', 64);
            $table->string('suffix', 4)->nullable();
            $table->string('certificate_complete_name', 150)->nullable();
            $table->string('nickname', 32)->nullable();
            $table->date('birth_date')->index()->nullable();
            $table->foreignId('institution_id')->nullable()->constrained('institutions');
            $table->char('graduated_at', 4)->nullable();
            $table->boolean('is_employed')->default(false);
            $table->tinyText('company_name')->nullable();
            $table->string('position', 256)->nullable();
            $table->string('member_type_id')->index()->nullable();
            $table->string('member_discount_type_id')->index()->nullable();
            $table->char('joined_at', 4)->index()->nullable();
            $table->string('license_number', 10)->nullable()->unique();
            $table->date('license_expiry_date')->nullable();
            $table->boolean('was_president')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
