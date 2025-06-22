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
        DB::statement("INSERT INTO categories (name) VALUES ('Легкий'), ('Хрупкий'), ('Тяжелый')", []);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("TRUNCATE TABLE categories");
    }
};
