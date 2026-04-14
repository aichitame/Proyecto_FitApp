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
        Schema::table('plans', function (Blueprint $table){
            $table->foreignId('client_request_id')
            ->nullable()
            ->after('user_id')
            ->constrained('client_requests')
            ->nullOnDelete();

            $table->unsignedInteger('version')->default(1)->after('client_request_id');

            $table->string('status')->default('draft')->after('description');
            $table->timestamp('published_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table){
           $table->dropConstrainedForeignId('client_request_id');
           $table->dropColumn([
            'version',
            'status',
            'published_at',
           ]);
        });
    }
};
