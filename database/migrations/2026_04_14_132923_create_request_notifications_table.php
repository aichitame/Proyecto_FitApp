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
        Schema::create('request_notifications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_request_id')
            ->constrained('client_requests')
            ->cascadeOnDelete();

            $table->string('type')->default('plan_available');

            $table->string('status')->default('pending');
            $table->timestamp('notified_at')->nullable();
            $table->text('error_message')->nullable();

            $table->unsignedInteger('attempts')->default(0);

            $table->foreignId('sent_by_user_id')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_notifications');
    }
};
