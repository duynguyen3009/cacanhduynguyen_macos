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
        Schema::create('setting', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('phone_number', 11);
            $table->string('link_facebook')->nullable();
            $table->string('link_youtube')->nullable();
            $table->string('link_tiktok')->nullable();
            $table->string('link_googlemap')->nullable();
            $table->string('company_name');
            $table->string('address');
            $table->string('email');
            $table->string('consulation_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting');
    }
};
