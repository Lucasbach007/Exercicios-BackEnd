<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create a view 'listaprod' for backward compatibility with legacy queries
        DB::statement(<<<'SQL'
            CREATE VIEW IF NOT EXISTS `listaprod` AS
            SELECT * FROM `produtos`;
        SQL
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS `listaprod`;');
    }
};
