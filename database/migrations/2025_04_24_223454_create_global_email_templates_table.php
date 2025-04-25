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
        Schema::create('global_email_templates', function (Blueprint $table) {
            $table->id();
            $table->longText('header')->nullable();
            $table->boolean('default_header')->default(false);
            $table->longText('footer')->nullable();
            $table->boolean('default_footer')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_email_templates');
    }
};
