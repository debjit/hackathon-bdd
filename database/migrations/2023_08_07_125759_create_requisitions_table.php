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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('hospital_id')->nullable()->constrained('hospitals');
            $table->string('patient_name');
            $table->string('primary_contact');
            $table->string('secondary_contact')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->tinyInteger('blood_group');
            $table->string('donation_type')->default('whole_blood');
            $table->datetime('required_on');
            $table->tinyInteger('status');// 0= not approved, 1=approved, 2 = Finished.
            $table->string('image')->nullable();
            $table->boolean('urgent')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitions');
    }
};