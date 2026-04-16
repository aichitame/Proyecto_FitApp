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
        Schema::create('client_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->integer('age');
            $table->string('gender');
            $table->decimal('height', 5, 2);
            $table->decimal('weight', 5, 2);

            $table->text('eating_habits');
            $table->boolean('has_allergies')->default(false);
            $table->text('allergies_description');

            $table->string('physical_activity_frequency');
            $table->text('physical_activity_type');
            $table->text('physical_limitations')->nullable();

            $table->string('goal');
            $table->text('additional_observations')->nullable();
            $table->boolean('orientative_service_acknowledged')->default(false);

            $table->string('status')->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('status_changed_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_requests');
    }
};
