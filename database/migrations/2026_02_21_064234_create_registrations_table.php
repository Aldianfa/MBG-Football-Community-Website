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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('event_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('team_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('no_wa')->unique();
            $table->string('email')->unique();

            $table->string('bukti_tf');

            $table->enum('status', [
                'pending_payment',
                'waiting_verification',
                'approved',
                'rejected',
                'expired'
            ])->default('pending_payment');

            $table->timestamp('expired_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
