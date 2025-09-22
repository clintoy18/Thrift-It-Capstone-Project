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
        // Step 1: remove AUTO_INCREMENT so we can drop the PK safely
        DB::statement('ALTER TABLE `notifications` MODIFY `id` BIGINT UNSIGNED NOT NULL');
        // Step 2: drop primary key
        DB::statement('ALTER TABLE `notifications` DROP PRIMARY KEY');
        // Step 3: change to CHAR(36)
        DB::statement('ALTER TABLE `notifications` MODIFY `id` CHAR(36) NOT NULL');
        // Step 4: re-add primary key
        DB::statement('ALTER TABLE `notifications` ADD PRIMARY KEY (`id`)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE `notifications` DROP PRIMARY KEY');
        DB::statement('ALTER TABLE `notifications` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
        DB::statement('ALTER TABLE `notifications` ADD PRIMARY KEY (`id`)');
    }
};
