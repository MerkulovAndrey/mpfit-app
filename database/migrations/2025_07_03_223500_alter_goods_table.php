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
        $sql = <<<'EOT'
            ALTER TABLE laravel.goods ADD deleted BOOL DEFAULT false NOT NULL COMMENT 'Признак удаления товара';
        EOT;
        DB::statement($sql, []);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP TABLE IF EXISTS lnk_orders_goods", []);

        $sql = <<<'EOT'
            ALTER TABLE laravel.goods DROP COLUMN deleted;
        EOT;
        DB::statement($sql, []);
    }
};
