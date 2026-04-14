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
        Schema::table('client_requests', function (Blueprint $table) {
            $table->string('job_activity')->nullable()->after('gender');

            $table->text('eating_habits')->nullable()->after('training_days');
            $table->boolean('has_allergies')->default(false)->after('eating_habits');
            $table->text('allergies_description')->nullable()->after('has_allergies');

            $table->string('physical_activity_frequency')->nullable()->after('allergies_description');
            $table->string('physical_activity_type')->nullable()->after('physical_activity_frequency');
            $table->text('physical_limitations')->nullable()->after('physical_activity_type');

            $table->text('additional_observations')->nullable()->after('goal');
            $table->boolean('orientative_service_acknowledged')->default(false)->after('additional_observations');

            $table->text('rejection_reason')->nullable()->after('status');

            $table->timestamp('status_changed_at')->nullable()->after('rejection_reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_requests', function (Blueprint $table) {
            $table->dropColumn([
                'job_activity',
                'eating_habits',
                'has_allergies',
                'allergies_description',
                'physical_activity_frequency',
                'physical_activity_type',
                'physical_limitations',
                'additional_observations',
                'orientative_service_acknowledged',
                'rejection_reason',
                'status_changed_at',
            ]);
        });
    }
};
