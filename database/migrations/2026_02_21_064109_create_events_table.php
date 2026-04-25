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
            $table->string('title');
            $table->text('description')->nullable();

            $table->integer('quota_total');
            $table->integer('team_limit');
            $table->integer('max_member_per_team');
            $table->enum('type',  ['Futsal', 'Basket', 'Badminton', 'Volleyball', 'MiniSoccer']);
            $table->string('type_slug');
            $table->date('date');
            $table->time('time_start');
            $table->time('time_end');
            $table->string('location');
            $table->string('location_map_url')->nullable();
            $table->integer('price')->default(0);
            $table->string('thumb_image');

            $table->enum('status', ['active', 'closed'])->default('active');

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
