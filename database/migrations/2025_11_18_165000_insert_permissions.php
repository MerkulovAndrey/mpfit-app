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
            INSERT INTO users_permissions (name,name_display,description)
            VALUES 
                ('cats.create','Создание категорий','Создание категорий'),
                ('cats.update','Редактирование категорий','Редактирование категорий'),
                ('cats.delete','Удаление категорий','Удаление категорий');
        EOT;
        DB::statement($sql, []);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("TRUNCATE TABLE users_permissions", []);
    }
};
