<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('foundation_profile_id');
        $table->unsignedBigInteger('category_id')->nullable();
        $table->string('title');
        $table->text('description');
        $table->decimal('goal_amount', 10, 2);
        $table->decimal('collected_amount', 10, 2)->default(0);
        $table->date('deadline');
        $table->timestamps();
        $table->foreign('foundation_profile_id')->references('id')->on('foundation_profiles')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
