<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Convert primary key from bigint to UUID (CHAR(36))
        DB::statement('ALTER TABLE `notifications` DROP PRIMARY KEY');
        DB::statement("ALTER TABLE `notifications` MODIFY `id` CHAR(36) NOT NULL");
        DB::statement('ALTER TABLE `notifications` ADD PRIMARY KEY (`id`)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert UUID back to bigint auto-increment primary key
        DB::statement('ALTER TABLE `notifications` DROP PRIMARY KEY');
        DB::statement('ALTER TABLE `notifications` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
        DB::statement('ALTER TABLE `notifications` ADD PRIMARY KEY (`id`)');
    }
};
